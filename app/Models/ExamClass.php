<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'class_id'
    ];

    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(Clazz::class);
    }
}
