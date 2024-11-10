<?php

namespace App\Models;

use App\Enums\SystemSettingEnum;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static updateOrCreate(array $array, mixed $setting)
 * @method static where(string $string, string $value)
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

    public static function getValue(SystemSettingEnum $setting): ?string
    {
        return self::where('name', $setting->value)->value('value');
    }
}
