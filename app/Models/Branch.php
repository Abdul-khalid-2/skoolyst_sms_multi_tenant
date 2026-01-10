<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'school_id',
        'name',
        'phone',
        'address',
        'status'
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    // ========== SCOPES ==========

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeBySchool($query, $schoolId = null)
    {
        $schoolId = $schoolId ?? auth()->user()->school_id;
        return $query->where('school_id', $schoolId);
    }

    public function scopeMainBranch($query)
    {
        // Assuming the main branch has a specific name or ID
        return $query->where('name', 'like', '%main%')
            ->orWhere('id', function ($q) {
                $q->select('id')
                    ->from('branches')
                    ->whereColumn('school_id', 'branches.school_id')
                    ->orderBy('created_at')
                    ->limit(1);
            });
    }

    // ========== ACCESSORS ==========

    public function getUsersCountAttribute()
    {
        return $this->users()->count();
    }

    public function getStudentsCountAttribute()
    {
        return $this->students()->count();
    }

    public function getTeachersCountAttribute()
    {
        return $this->teachers()->count();
    }

    public function getIsMainAttribute()
    {
        // Check if this is the main branch (first created or named 'Main')
        return $this->name == 'Main' ||
            $this->id == Branch::where('school_id', $this->school_id)
            ->orderBy('created_at')
            ->first()?->id;
    }
}
