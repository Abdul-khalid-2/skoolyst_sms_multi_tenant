<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicYear extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'school_id',
        'name',
        'start_date',
        'end_date',
        'is_active'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function school()
    {
        // return $this->belongsTo(School::class);
    }

    public function students()
    {
        // return $this->hasMany(Student::class);
    }

    public function exams()
    {
        // return $this->hasMany(Exam::class);
    }

    // Get active academic year
    public static function getActive($schoolId)
    {
        return self::where('school_id', $schoolId)
            ->where('is_active', true)
            ->first();
    }
}
