<?php

namespace Database\Seeders;

use App\Enums\SystemSettingEnum;
use App\Models\SystemSetting;
use Illuminate\Database\Seeder;

class SystemSettingSeeder extends Seeder
{
    private array $settings = [
        [
            'name' => SystemSettingEnum::BANK_NAME,
            'value' => ''
        ],

        [
            'name' => SystemSettingEnum::BANK_ACCOUNT,
            'value' => ''
        ],

        [
            'name' => SystemSettingEnum::BANK_SWIFT,
            'value' => ''
        ],

        [
            'name' => SystemSettingEnum::EMAIL,
            'value' => ''
        ],

        [
            'name' => SystemSettingEnum::PHONE,
            'value' => ''
        ],

        [
            'name' => SystemSettingEnum::COMPANY_NAME,
            'value' => ''
        ],

        [
            'name' => SystemSettingEnum::COMPANY_CODE,
            'value' => ''
        ],

        [
            'name' => SystemSettingEnum::COMPANY_VAT_CODE,
            'value' => ''
        ],

        [
            'name' => SystemSettingEnum::COUNTRY,
            'value' => ''
        ],

        [
            'name' => SystemSettingEnum::CITY,
            'value' => ''
        ],

        [
            'name' => SystemSettingEnum::STREET,
            'value' => ''
        ],

        [
            'name' => SystemSettingEnum::HOUSE_NUMBER,
            'value' => ''
        ],

        [
            'name' => SystemSettingEnum::OFFICE_NUMBER,
            'value' => ''
        ],

        [
            'name' => SystemSettingEnum::POST_CODE,
            'value' => ''
        ],
    ];

    public function run(): void
    {
        foreach ($this->settings as $setting) {
            SystemSetting::updateOrCreate([
                'name' => $setting['name'],
            ], $setting);
        }
    }
}
