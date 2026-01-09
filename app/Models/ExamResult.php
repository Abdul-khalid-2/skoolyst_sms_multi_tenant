<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'exam_id',
        'subject_id',
        'obtained_marks',
        'total_marks',
        'grade',
        'percentage',
        'remarks',
        'graded_by'
    ];

    protected $casts = [
        'obtained_marks' => 'decimal:2',
        'total_marks' => 'decimal:2',
        'percentage' => 'decimal:2'
    ];

    // Relationships
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function gradedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'graded_by');
    }

    // Scopes
    public function scopeByStudent($query, $studentId)
    {
        return $query->where('student_id', $studentId);
    }

    public function scopeByExam($query, $examId)
    {
        return $query->where('exam_id', $examId);
    }

    public function scopeBySubject($query, $subjectId)
    {
        return $query->where('subject_id', $subjectId);
    }

    // Helper methods
    public function getResultAttribute()
    {
        return $this->obtained_marks >= $this->total_marks * 0.33 ? 'pass' : 'fail';
    }

    public function getGradeAttribute($value)
    {
        if (!$value) {
            // Auto-calculate grade based on percentage
            $percentage = $this->percentage;

            if ($percentage >= 90) return 'A+';
            if ($percentage >= 80) return 'A';
            if ($percentage >= 70) return 'B';
            if ($percentage >= 60) return 'C';
            if ($percentage >= 50) return 'D';
            if ($percentage >= 40) return 'E';
            return 'F';
        }

        return $value;
    }
}
