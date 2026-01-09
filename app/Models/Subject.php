<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'school_id',
        'name',
        'code',
        'type',
        'category',
        'credit_hours',
        'total_marks',
        'passing_marks',
        'weekly_periods',
        'period_duration',
        'is_optional',
        'has_lab',
        'enable_exams',
        'enable_homework',
        'default_teacher_id',
        'short_description',
        'syllabus',
        'objectives',
        'status'
    ];

    protected $casts = [
        'credit_hours' => 'decimal:1',
        'total_marks' => 'integer',
        'passing_marks' => 'integer',
        'weekly_periods' => 'integer',
        'period_duration' => 'integer',
        'is_optional' => 'boolean',
        'has_lab' => 'boolean',
        'enable_exams' => 'boolean',
        'enable_homework' => 'boolean'
    ];

    // Relationships
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(
            Clazz::class,
            'class_subjects',
            'subject_id',
            'class_id'
        )
            ->withPivot('is_compulsory')
            ->withTimestamps();
    }

    public function defaultTeacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'default_teacher_id');
    }


    // Replace the exams() relationship with:
    public function examSchedules(): HasMany
    {
        return $this->hasMany(ExamSchedule::class);
    }

    public function examResults(): HasMany
    {
        return $this->hasMany(ExamResult::class);
    }

    // If you need to get exams through schedules, you can add:
    public function exams()
    {
        return $this->hasManyThrough(Exam::class, ExamSchedule::class, 'subject_id', 'id', 'id', 'exam_id')
            ->distinct();
    }

    // Update the canBeDeleted() method:
    public function canBeDeleted()
    {
        return $this->examSchedules()->count() === 0 &&
            $this->examResults()->count() === 0 &&
            $this->classes()->count() === 0;
    }

    // Update the getExamsCountAttribute method (if you want to count exams):
    public function getExamsCountAttribute()
    {
        return $this->exams()->count();
    }


    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeTheory($query)
    {
        return $query->where('type', 'theory');
    }

    public function scopePractical($query)
    {
        return $query->where('type', 'practical');
    }

    public function scopeOptional($query)
    {
        return $query->where('is_optional', true);
    }

    public function scopeCompulsory($query)
    {
        return $query->where('is_optional', false);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Helper methods
    public function getClassesCountAttribute()
    {
        return $this->classes()->count();
    }

    public function getStudentsCountAttribute()
    {
        // Get total students from all classes that have this subject
        $totalStudents = 0;
        foreach ($this->classes as $class) {
            $totalStudents += $class->students()->count();
        }
        return $totalStudents;
    }

    public function getTypeBadgeAttribute()
    {
        $badges = [
            'theory' => 'badge-success',
            'practical' => 'badge-warning',
            'both' => 'badge-info',
            'project' => 'badge-primary',
            'activity' => 'badge-secondary'
        ];

        return $badges[$this->type] ?? 'badge-secondary';
    }
}
