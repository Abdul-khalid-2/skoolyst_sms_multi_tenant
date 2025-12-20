<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $fillable = [
        'school_id',
        'branch_id',
        'name',
        'email',
        'password',
        'phone',
        'address',
        'profile_image',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'status' => 'string',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // Check if user is super admin (no school assigned)
    public function isSuperAdmin()
    {
        return is_null($this->school_id);
    }

    // Check if user is school admin
    public function isSchoolAdmin()
    {
        return $this->hasRole('School Admin');
    }

    // Scope for school users
    public function scopeForSchool($query, $schoolId)
    {
        return $query->where('school_id', $schoolId);
    }

    // Scope for active users
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
