<?php

namespace App\Models\GiftCards;

use App\Enums\GiftCardStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GiftCardRedemption extends Model
{
    protected $fillable = [
        'gift_card_id',
        'redeemed_by',
        'status_before',
        'status_after',
        'redeemed_amount',
    ];

    public function giftCard(): BelongsTo
    {
        return $this->belongsTo(GiftCard::class);
    }

    public function redeemedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'redeemed_by');
    }

    protected function statusBefore(): Attribute
    {
        return Attribute::make(
            get: fn(int $value) => GiftCardStatus::from($value),
        );
    }

    protected function statusAfter(): Attribute
    {
        return Attribute::make(
            get: fn(int $value) => GiftCardStatus::from($value),
        );
    }
}
