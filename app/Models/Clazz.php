<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clazz extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'classes';

    protected $fillable = [
        'school_id',
        'academic_year_id',
        'name',
        'code',
        'order_no',
        'education_system',
        'min_age',
        'max_age',
        'next_class_id',
        'enable_sections',
        'status',
        'description'
    ];

    protected $casts = [
        'enable_sections' => 'boolean',
        'order_no' => 'integer',
        'min_age' => 'integer',
        'max_age' => 'integer'
    ];

    // Relationships
    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    public function sections()
    {
        return $this->hasMany(Section::class, 'class_id');
    }

    public function nextClass()
    {
        return $this->belongsTo(Clazz::class, 'next_class_id');
    }

    public function previousClass()
    {
        return $this->hasOne(Clazz::class, 'next_class_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'class_subjects');
    }

    public function feeStructures()
    {
        return $this->hasMany(FeeStructure::class, 'class_id');
    }

    // ========== SCOPES ==========

    // Scope for active classes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope for current school
    public function scopeBySchool($query, $schoolId = null)
    {
        $schoolId = $schoolId ?? auth()->user()->school_id;
        return $query->where('school_id', $schoolId);
    }

    public function scopeByAcademicYear($query, $academicYearId = null)
    {
        if ($academicYearId) {
            return $query->where('academic_year_id', $academicYearId);
        }
        return $query;
    }

    public function scopeWithSections($query)
    {
        return $query->where('enable_sections', true);
    }

    public function scopeCurrentAcademicYear($query)
    {
        $academicYearId = AcademicYear::getActive()?->id;
        return $query->where('academic_year_id', $academicYearId);
    }

    // Scope to get classes with available capacity
    public function scopeWithCapacity($query)
    {
        return $query->whereHas('sections', function ($q) {
            $q->whereRaw('(SELECT COUNT(*) FROM students WHERE section_id = sections.id) < capacity');
        }, '>', 0);
    }

    // ========== ACCESSORS ==========

    public function getFullNameAttribute()
    {
        $name = $this->name;
        if ($this->code) {
            $name .= " ({$this->code})";
        }
        return $name;
    }

    public function getEducationSystemNameAttribute()
    {
        return match ($this->education_system) {
            'matric' => 'Matriculation',
            'igcse' => 'IGCSE',
            'alevel' => 'A-Level',
            'ib' => 'International Baccalaureate',
            default => ucfirst($this->education_system),
        };
    }

    // Get students count
    public function getStudentsCountAttribute()
    {
        return $this->students()->count();
    }

    // Get active students count
    public function getActiveStudentsCountAttribute()
    {
        return $this->students()->active()->count();
    }

    // Get sections count
    public function getSectionsCountAttribute()
    {
        return $this->sections()->count();
    }

    // Check if class has capacity
    public function hasCapacity()
    {
        if (!$this->enable_sections) {
            return true; // No section capacity limits
        }

        $totalCapacity = $this->sections->sum('capacity');
        $currentStudents = $this->students()->count();

        return $currentStudents < $totalCapacity;
    }

    // Get available sections
    public function getAvailableSections()
    {
        if (!$this->enable_sections) {
            return collect([]);
        }

        return $this->sections()
            ->whereHas('class', function ($query) {
                $query->active();
            })
            ->get();
    }

    // Get next class name
    public function getNextClassNameAttribute()
    {
        return $this->nextClass ? $this->nextClass->name : 'Graduated';
    }

    // Get class teacher (if sections have class teachers)
    public function getClassTeachersAttribute()
    {
        if (!$this->enable_sections) {
            return collect([]);
        }

        return $this->sections()
            ->with('classTeacher')
            ->get()
            ->pluck('classTeacher')
            ->filter()
            ->unique('id');
    }

    // Get total capacity
    public function getTotalCapacityAttribute()
    {
        if (!$this->enable_sections) {
            return null; // No capacity limit without sections
        }

        return $this->sections->sum('capacity');
    }

    // Get available seats
    public function getAvailableSeatsAttribute()
    {
        if (!$this->enable_sections) {
            return null;
        }

        $totalCapacity = $this->sections->sum('capacity');
        $currentStudents = $this->students()->count();

        return max(0, $totalCapacity - $currentStudents);
    }

    // Get occupancy percentage
    public function getOccupancyPercentageAttribute()
    {
        if (!$this->enable_sections) {
            return null;
        }

        $totalCapacity = $this->sections->sum('capacity');
        if ($totalCapacity == 0) {
            return 0;
        }

        $currentStudents = $this->students()->count();
        return round(($currentStudents / $totalCapacity) * 100, 2);
    }

    // Get subjects as comma separated string
    public function getSubjectsListAttribute()
    {
        return $this->subjects->pluck('name')->implode(', ');
    }

    // Check if class can be promoted
    public function canBePromoted()
    {
        return $this->next_class_id !== null;
    }
}
