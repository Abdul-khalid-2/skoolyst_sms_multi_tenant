<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'description',
        'icon',
        'route',
        'order',
        'is_core',
        'is_active',
        'permissions',
        'submodules'
    ];

    protected $casts = [
        'is_core' => 'boolean',
        'is_active' => 'boolean',
        'permissions' => 'array',
        'submodules' => 'array',
    ];

    public function schoolModules()
    {
        return $this->hasMany(SchoolModule::class);
    }

    public function widgets()
    {
        return $this->hasMany(ModuleWidget::class);
    }

    public function getPermissionListAttribute()
    {
        return $this->permissions ?? [];
    }

    public function getSubmoduleListAttribute()
    {
        return $this->submodules ?? [];
    }
}
