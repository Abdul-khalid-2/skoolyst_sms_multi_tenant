<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'class_id',
        'name',
        'capacity'
    ];

    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }

    public function students()
    {
        // return $this->hasMany(Student::class);
    }

    public function teacherSubjects()
    {
        // return $this->hasMany(TeacherSubject::class);
    }
}
