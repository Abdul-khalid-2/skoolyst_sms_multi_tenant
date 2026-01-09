<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassSubject extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'subject_id',
        'is_compulsory'
    ];

    protected $casts = [
        'is_compulsory' => 'boolean'
    ];

    // Relationships
    public function class(): BelongsTo
    {
        return $this->belongsTo(Clazz::class, 'class_id');
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    // Scopes
    public function scopeCompulsory($query)
    {
        return $query->where('is_compulsory', true);
    }

    public function scopeOptional($query)
    {
        return $query->where('is_compulsory', false);
    }

    public function scopeByClass($query, $classId)
    {
        return $query->where('class_id', $classId);
    }

    public function scopeBySubject($query, $subjectId)
    {
        return $query->where('subject_id', $subjectId);
    }
}
