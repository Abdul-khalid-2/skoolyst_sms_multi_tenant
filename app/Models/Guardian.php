<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guardian extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'school_id',
        'first_name',
        'last_name',
        'relation',
        'phone',
        'email',
        'occupation',
        'monthly_income',
        'address',
        'cnic',
        'status',
    ];

    protected $casts = [
        'monthly_income' => 'decimal:2',
    ];

    protected $appends = ['full_name'];

    // Relationships
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'student_guardians')
            ->withPivot('is_primary')
            ->withTimestamps();
    }

    public function studentGuardians()
    {
        return $this->hasMany(StudentGuardian::class);
    }

    // Accessor for full name
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // Scope for active guardians
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope for school
    public function scopeBySchool($query, $schoolId = null)
    {
        $schoolId = $schoolId ?? auth()->user()->school_id;
        return $query->where('school_id', $schoolId);
    }
}
