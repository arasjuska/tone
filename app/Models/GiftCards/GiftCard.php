<?php

namespace App\Models\GiftCards;

use App\Enums\GiftCardStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * @property Carbon $created_at
 * @property Carbon $expires_at
 * @property int $expiration_months
 * @property int $status
 * @property int $amount
 */
class GiftCard extends Model
{
    protected $fillable = [
        'code',
        'status',
        'amount',
        'remaining_amount',
        'email',
        'email_gift',
        'expiration_months',
    ];

    protected $casts = [
        'status' => GiftCardStatus::class,
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($giftCard) {
            $giftCard->code = Str::uuid();
            $giftCard->remaining_amount = $giftCard->amount;
        });
    }

    public function giftCardRedemptions(): HasMany
    {
        return $this->hasMany(GiftCardRedemption::class);
    }

    protected function expiresAt(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->created_at
                ->copy()
                ->addMonths($this->expiration_months)
                ->format('Y-m-d'),
        );
    }

    protected function isValid(): Attribute
    {
        return Attribute::make(
            get: fn() => in_array($this->status, [
                GiftCardStatus::ACTIVE,
                GiftCardStatus::PARTIALLY_REDEEMED,
            ])
        );
    }
}
