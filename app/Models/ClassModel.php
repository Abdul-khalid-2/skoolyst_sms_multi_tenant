<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'classes';

    protected $fillable = [
        'school_id',
        'name',
        'order'
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function students()
    {
        // return $this->hasMany(Student::class);
    }

    public function feeStructures()
    {
        // return $this->hasMany(FeeStructure::class);
    }

    public function subjects()
    {
        // return $this->belongsToMany(Subject::class, 'class_subjects');
    }

    public function teacherSubjects()
    {
        // return $this->hasMany(TeacherSubject::class);
    }
}
