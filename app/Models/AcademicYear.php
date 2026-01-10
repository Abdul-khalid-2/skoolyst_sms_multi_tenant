<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AcademicYear extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'school_id',
        'name',
        'code', // Add this
        'start_date',
        'end_date',
        'is_active',
        'status', // Add this
        'description' // Add this
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function classes(): HasMany
    {
        return $this->hasMany(Clazz::class);
    }

    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }

    public function feeStructures(): HasMany
    {
        return $this->hasMany(FeeStructure::class);
    }

    // ========== SCOPES ==========

    // Scope for active academic years
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where('status', 'active');
    }

    // Scope for inactive academic years
    public function scopeInactive($query)
    {
        return $query->where('is_active', false)
            ->orWhere('status', '!=', 'active');
    }

    // Scope for archived academic years
    public function scopeArchived($query)
    {
        return $query->where('status', 'archived');
    }


    // Get active academic year
    public static function getActive($schoolId = null)
    {
        if (!$schoolId) {
            // If school ID not provided, try to get from authenticated user
            $schoolId = auth()->check() ? auth()->user()->school_id : null;
        }

        return self::where('school_id', $schoolId)
            ->where('is_active', true)
            ->where('status', 'active')
            ->first();
    }

    // Scope for current school
    public function scopeCurrentSchool($query)
    {
        $schoolId = auth()->check() ? auth()->user()->school_id : null;
        return $query->where('school_id', $schoolId);
    }

    public function scopeBySchool($query, $schoolId = null)
    {
        $schoolId = $schoolId ?? auth()->user()->school_id;
        return $query->where('school_id', $schoolId);
    }

    public function scopeCurrent($query)
    {
        return $query->where('is_active', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now());
    }

    // Accessors
    public function getIsCurrentAttribute()
    {
        return $this->is_active &&
            $this->start_date <= now() &&
            $this->end_date >= now();
    }

    public function getDurationAttribute()
    {
        return $this->start_date->format('M Y') . ' - ' . $this->end_date->format('M Y');
    }
}
