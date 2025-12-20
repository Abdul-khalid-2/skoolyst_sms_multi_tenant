<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'key',
        'value'
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    // Get setting value by key
    public static function getValue($key, $schoolId = null, $default = null)
    {
        $setting = self::where('key', $key)
            ->when($schoolId, function ($query) use ($schoolId) {
                return $query->where('school_id', $schoolId);
            }, function ($query) {
                return $query->whereNull('school_id');
            })
            ->first();

        return $setting ? $setting->value : $default;
    }

    // Set setting value
    public static function setValue($key, $value, $schoolId = null)
    {
        return self::updateOrCreate(
            [
                'school_id' => $schoolId,
                'key' => $key
            ],
            ['value' => $value]
        );
    }
}
