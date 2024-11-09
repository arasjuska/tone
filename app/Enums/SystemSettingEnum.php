<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum SystemSettingEnum: string implements HasLabel
{
    case BANK_NAME = 'BANK_NAME';
    case BANK_ACCOUNT = 'BANK_ACCOUNT';
    case BANK_SWIFT = 'BANK_SWIFT';
    case EMAIL = 'EMAIL';
    case PHONE = 'PHONE';
    case COMPANY_NAME = 'COMPANY_NAME';
    case COMPANY_CODE = 'COMPANY_CODE';
    case COMPANY_VAT_CODE = 'COMPANY_VAT_CODE';
    case COUNTRY = 'COUNTRY';
    case CITY = 'CITY';
    case STREET = 'STREET';
    case HOUSE_NUMBER = 'HOUSE_NUMBER';
    case OFFICE_NUMBER = 'OFFICE_NUMBER';
    case POST_CODE = 'POST_CODE';

    public function getLabel(): string
    {
        return match ($this) {
            self::BANK_NAME => __('system-settings.bank_name'),
            self::BANK_ACCOUNT => __('system-settings.bank_account'),
            self::BANK_SWIFT => __('system-settings.bank_swift_code'),
            self::EMAIL => __('system-settings.email'),
            self::PHONE => __('system-settings.phone'),
            self::COMPANY_NAME => __('system-settings.company_name'),
            self::COMPANY_CODE => __('system-settings.company_code'),
            self::COMPANY_VAT_CODE => __('system-settings.company_vat_code'),
            self::COUNTRY => __('system-settings.country'),
            self::CITY => __('system-settings.city'),
            self::STREET => __('system-settings.street'),
            self::HOUSE_NUMBER => __('system-settings.house_number'),
            self::OFFICE_NUMBER => __('system-settings.office_number'),
            self::POST_CODE => __('system-settings.post_code'),
        };
    }
}
