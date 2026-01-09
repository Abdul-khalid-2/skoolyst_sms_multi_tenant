<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'class_id',
        'subject_id',
        'exam_date',
        'start_time',
        'end_time',
        'venue',
        'supervisor_id'
    ];

    protected $casts = [
        'exam_date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime'
    ];

    // Relationships
    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(Clazz::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    // Scopes
    public function scopeUpcoming($query)
    {
        return $query->where('exam_date', '>=', now());
    }

    public function scopeCompleted($query)
    {
        return $query->where('exam_date', '<', now());
    }
}
