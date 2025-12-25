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
        // return $this->submodules ?? [];
        $submodules = $this->submodules ?? [];

        // Ensure each submodule has required keys
        return array_map(function ($submodule, $index) {
            if (is_string($submodule)) {
                return [
                    'code' => $submodule,
                    'name' => ucfirst(str_replace('_', ' ', $submodule)),
                    'description' => null
                ];
            }

            if (is_array($submodule)) {
                return [
                    'code' => $submodule['code'] ?? 'submodule_' . $index,
                    'name' => $submodule['name'] ?? 'Submodule ' . ($index + 1),
                    'description' => $submodule['description'] ?? null
                ];
            }

            return [
                'code' => 'submodule_' . $index,
                'name' => 'Submodule ' . ($index + 1),
                'description' => null
            ];
        }, $submodules, array_keys($submodules));
    }
}
