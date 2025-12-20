<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolModule extends Model
{
    protected $fillable = [
        'school_id',
        'module_id',
        'is_active',
        'settings',
        'activated_at',
        'deactivated_at'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'settings' => 'array',
        'activated_at' => 'datetime',
        'deactivated_at' => 'datetime',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function activate()
    {
        $this->update([
            'is_active' => true,
            'activated_at' => now(),
            'deactivated_at' => null,
        ]);
    }

    public function deactivate()
    {
        $this->update([
            'is_active' => false,
            'deactivated_at' => now(),
        ]);
    }
}
