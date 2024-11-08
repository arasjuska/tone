<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ExpirationPeriod: int implements HasLabel
{
    case ONE_MONTH = 1;
    case TWO_MONTHS = 2;
    case THREE_MONTHS = 3;
    case FOUR_MONTHS = 4;
    case FIVE_MONTHS = 5;
    case SIX_MONTHS = 6;
    case SEVEN_MONTHS = 7;
    case EIGHT_MONTHS = 8;
    case NINE_MONTHS = 9;
    case TEN_MONTHS = 10;
    case ELEVEN_MONTHS = 11;
    case TWELVE_MONTHS = 12;

    public function getLabel(): string
    {
        return match ($this) {
            self::ONE_MONTH => __('expiration_periods.1_month'),
            self::TWO_MONTHS => __('expiration_periods.2_months'),
            self::THREE_MONTHS => __('expiration_periods.3_months'),
            self::FOUR_MONTHS => __('expiration_periods.4_months'),
            self::FIVE_MONTHS => __('expiration_periods.5_months'),
            self::SIX_MONTHS => __('expiration_periods.6_months'),
            self::SEVEN_MONTHS => __('expiration_periods.7_months'),
            self::EIGHT_MONTHS => __('expiration_periods.8_months'),
            self::NINE_MONTHS => __('expiration_periods.9_months'),
            self::TEN_MONTHS => __('expiration_periods.10_months'),
            self::ELEVEN_MONTHS => __('expiration_periods.11_months'),
            self::TWELVE_MONTHS => __('expiration_periods.12_months'),
        };
    }
}
