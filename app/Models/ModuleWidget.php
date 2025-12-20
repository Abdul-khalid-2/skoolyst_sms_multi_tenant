<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleWidget extends Model
{
    protected $fillable = [
        'module_id',
        'name',
        'component',
        'position',
        'data_source',
        'is_active'
    ];

    protected $casts = [
        'data_source' => 'array',
        'is_active' => 'boolean',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
