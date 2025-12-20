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
        // return $this->hasMany(Student::class);
    }

    public function teachers()
    {
        // return $this->hasMany(Teacher::class);
    }
}
