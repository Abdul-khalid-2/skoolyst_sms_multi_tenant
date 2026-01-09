<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'school_id',
        'branch_id',
        'academic_year_id',
        'class_id',
        'section_id',
        'admission_no',
        'roll_no',
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'blood_group',
        'religion',
        'nationality',
        'cnic',
        'phone',
        'email',
        'address',
        'photo',
        'admission_date',
        'status',
        'previous_school',
        'medical_info'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'admission_date' => 'date',
        'medical_info' => 'array'
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
        // classes table is clazz
        return $this->belongsTo(Clazz::class, 'class_id');
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Accessor for full name
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // Scope for active students
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope for current academic year
    public function scopeCurrentYear($query)
    {
        $academicYearId = AcademicYear::getActive()?->id;
        return $query->where('academic_year_id', $academicYearId);
    }
}
