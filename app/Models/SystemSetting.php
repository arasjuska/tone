<?php

namespace App\Models;

use App\Enums\SystemSettingEnum;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static updateOrCreate(array $array, mixed $setting)
 */
class SystemSetting extends Model
{
    protected $fillable = [
        'name',
        'value',
    ];

    protected $casts = [
        'name' => SystemSettingEnum::class,
    ];
}
