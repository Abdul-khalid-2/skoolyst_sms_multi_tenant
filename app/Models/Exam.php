<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exam extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'school_id',
        'academic_year_id',
        'name',
        'code',
        'start_date',
        'end_date',
        'type',
        'total_marks',
        'passing_marks',
        'is_active',
        'description'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'total_marks' => 'decimal:2',
        'passing_marks' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    // Relationships
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(Clazz::class, 'exam_classes')
            ->withTimestamps();
    }

    public function examSchedules(): HasMany
    {
        return $this->hasMany(ExamSchedule::class);
    }

    public function examResults(): HasMany
    {
        return $this->hasMany(ExamResult::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeCurrentYear($query)
    {
        $academicYearId = AcademicYear::getActive()?->id;
        return $query->where('academic_year_id', $academicYearId);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', now());
    }

    public function scopeOngoing($query)
    {
        return $query->where('start_date', '<=', now())
            ->where('end_date', '>=', now());
    }

    public function scopeCompleted($query)
    {
        return $query->where('end_date', '<', now());
    }

    // Helper methods
    public function getStatusAttribute()
    {
        $today = now();

        if ($today->lt($this->start_date)) {
            return 'upcoming';
        } elseif ($today->gt($this->end_date)) {
            return 'completed';
        } else {
            return 'ongoing';
        }
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'upcoming' => 'badge-info',
            'ongoing' => 'badge-success',
            'completed' => 'badge-secondary'
        ];

        return $badges[$this->status] ?? 'badge-secondary';
    }

    public function canBeDeleted()
    {
        return $this->examResults()->count() === 0;
    }

    public function getClassesCountAttribute()
    {
        return $this->classes()->count();
    }

    public function getSubjectsCountAttribute()
    {
        return $this->examSchedules()->distinct('subject_id')->count('subject_id');
    }
}
