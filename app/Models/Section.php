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

    // Get students count
    public function getStudentsCountAttribute()
    {
        return $this->students()->count();
    }
}
