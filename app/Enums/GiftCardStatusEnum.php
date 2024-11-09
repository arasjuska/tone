<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum GiftCardStatusEnum: int implements HasLabel, HasColor
{
    case PENDING_ACTIVATION = 0;
    case ACTIVE = 1;
    case PARTIALLY_REDEEMED = 2;
    case REDEEMED = 3;
    case EXPIRED = 4;
    case CANCELLED = 5;
    case INVALID = 6;

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING_ACTIVATION => __('gift_card_statuses.pending_activation'),
            self::ACTIVE => __('gift_card_statuses.active'),
            self::PARTIALLY_REDEEMED => __('gift_card_statuses.partially_redeemed'),
            self::REDEEMED => __('gift_card_statuses.redeemed'),
            self::EXPIRED => __('gift_card_statuses.expired'),
            self::CANCELLED => __('gift_card_statuses.cancelled'),
            self::INVALID => __('gift_card_statuses.invalid'),
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::PENDING_ACTIVATION => 'warning',
            self::ACTIVE => 'success',
            self::PARTIALLY_REDEEMED => 'warning',
            self::REDEEMED => 'danger',
            self::EXPIRED => 'danger',
            self::CANCELLED => 'danger',
            self::INVALID => 'danger',
        };
    }
}
