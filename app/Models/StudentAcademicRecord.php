<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentAcademicRecord extends Model
{
    /** @use HasFactory<\Database\Factories\StudentAcademicRecordFactory> */
    use HasFactory;

    protected $fillable = [
        'student_id',
        'academic_year_id',
        'class_id',
        'section_id',
        'roll_no',
        'start_date',
        'end_date',
        'result',
        'percentage',
        'grade',
        'position',
        'remarks'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'percentage' => 'decimal:2',
        'position' => 'integer'
    ];

    // Relationships
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(Clazz::class, 'class_id');
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    // Scopes
    public function scopeCurrent($query)
    {
        return $query->whereNull('end_date');
    }

    public function scopeCompleted($query)
    {
        return $query->whereNotNull('end_date');
    }

    public function scopeByAcademicYear($query, $academicYearId)
    {
        return $query->where('academic_year_id', $academicYearId);
    }

    public function scopeByStudent($query, $studentId)
    {
        return $query->where('student_id', $studentId);
    }

    public function scopePassed($query)
    {
        return $query->where('result', 'pass')->orWhere('result', 'promoted');
    }

    public function scopeFailed($query)
    {
        return $query->where('result', 'fail');
    }

    // Accessors
    public function getStatusAttribute()
    {
        return $this->end_date ? 'Completed' : 'Current';
    }

    public function getDurationAttribute()
    {
        if ($this->start_date && $this->end_date) {
            return $this->start_date->format('M Y') . ' - ' . $this->end_date->format('M Y');
        } elseif ($this->start_date) {
            return $this->start_date->format('M Y') . ' - Present';
        }
        return 'N/A';
    }

    public function getResultBadgeAttribute()
    {
        $badgeClass = match ($this->result) {
            'pass', 'promoted' => 'badge-success',
            'fail' => 'badge-danger',
            'pending' => 'badge-warning',
            default => 'badge-secondary'
        };

        return '<span class="badge ' . $badgeClass . '">' . ucfirst($this->result) . '</span>';
    }

    public function getGradeColorAttribute()
    {
        return match ($this->grade) {
            'A+', 'A', 'A-' => 'text-success',
            'B+', 'B', 'B-' => 'text-primary',
            'C+', 'C', 'C-' => 'text-info',
            'D+', 'D', 'D-' => 'text-warning',
            'F' => 'text-danger',
            default => 'text-secondary'
        };
    }

    // Calculate academic year completion
    public function isCompleted()
    {
        return !is_null($this->end_date);
    }

    // Check if student passed
    public function isPassed()
    {
        return in_array($this->result, ['pass', 'promoted']);
    }

    // Get next class (if applicable)
    public function getNextClassAttribute()
    {
        return $this->class->nextClass ?? null;
    }

    // Get performance rating
    public function getPerformanceRatingAttribute()
    {
        if (!$this->percentage) {
            return 'N/A';
        }

        if ($this->percentage >= 80) return 'Excellent';
        if ($this->percentage >= 70) return 'Very Good';
        if ($this->percentage >= 60) return 'Good';
        if ($this->percentage >= 50) return 'Average';
        if ($this->percentage >= 40) return 'Below Average';
        return 'Poor';
    }
}
