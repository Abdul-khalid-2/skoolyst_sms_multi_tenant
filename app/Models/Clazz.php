<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clazz extends Model
{
    /** @use HasFactory<\Database\Factories\ClazzFactory> */
    use HasFactory;
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
        'enable_sections' => 'boolean'
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

    // Scope for active classes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Get students count
    public function getStudentsCountAttribute()
    {
        return $this->students()->count();
    }
}
