<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'class_id',
        'academic_year_id',
        'name',
        'code',
        'capacity',
        'shift',
        'room_number',
        'start_time',
        'end_time',
        'weekdays',
        'class_teacher_id',
        'assistant_teacher_id',
        'enable_attendance',
        'enable_fee_collection',
        'status',
        'description'
    ];

    protected $casts = [
        'weekdays' => 'array',
        'enable_attendance' => 'boolean',
        'enable_fee_collection' => 'boolean',
        'start_time' => 'datetime',
        'end_time' => 'datetime'
    ];

    // Relationships
    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(Clazz::class, 'class_id');
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function classTeacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'class_teacher_id');
    }

    public function assistantTeacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assistant_teacher_id');
    }

    // ========== SCOPES ==========

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeBySchool($query, $schoolId = null)
    {
        $schoolId = $schoolId ?? auth()->user()->school_id;
        return $query->where('school_id', $schoolId);
    }

    public function scopeByClass($query, $classId)
    {
        return $query->where('class_id', $classId);
    }

    public function scopeByAcademicYear($query, $academicYearId = null)
    {
        if ($academicYearId) {
            return $query->where('academic_year_id', $academicYearId);
        }
        return $query;
    }

    public function scopeWithCapacity($query)
    {
        return $query->whereRaw('(SELECT COUNT(*) FROM students WHERE section_id = sections.id) < capacity');
    }

    // ========== ACCESSORS ==========

    public function getStudentsCountAttribute()
    {
        return $this->students()->count();
    }

    public function getAvailableSeatsAttribute()
    {
        return max(0, $this->capacity - $this->students_count);
    }

    public function getIsFullAttribute()
    {
        return $this->students_count >= $this->capacity;
    }

    public function getOccupancyPercentageAttribute()
    {
        if ($this->capacity == 0) {
            return 0;
        }
        return round(($this->students_count / $this->capacity) * 100, 2);
    }

    public function getWeekdaysListAttribute()
    {
        if (empty($this->weekdays)) {
            return 'Not Set';
        }

        $daysMap = [
            'monday' => 'Mon',
            'tuesday' => 'Tue',
            'wednesday' => 'Wed',
            'thursday' => 'Thu',
            'friday' => 'Fri',
            'saturday' => 'Sat',
            'sunday' => 'Sun'
        ];

        $days = array_map(function ($day) use ($daysMap) {
            return $daysMap[$day] ?? ucfirst($day);
        }, $this->weekdays);

        return implode(', ', $days);
    }

    public function getDurationAttribute()
    {
        if ($this->start_time && $this->end_time) {
            return $this->start_time->format('h:i A') . ' - ' . $this->end_time->format('h:i A');
        }
        return 'Not Set';
    }
}
