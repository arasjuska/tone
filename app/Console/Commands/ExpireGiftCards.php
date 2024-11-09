<?php

namespace App\Console\Commands;

use App\Enums\GiftCardStatusEnum;
use App\Models\GiftCards\GiftCard;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExpireGiftCards extends Command
{
    protected $signature = 'giftcards:expire';
    protected $description = 'Update expired gift cards';

    public function handle(): void
    {
        GiftCard::whereIn('status', [
            GiftCardStatusEnum::ACTIVE,
            GiftCardStatusEnum::PARTIALLY_REDEEMED
        ])
            ->get()
            ->each(function ($giftCard) {
                if (Carbon::parse($giftCard->created_at)->addMonths($giftCard->expiration_months)->isPast()) {
                    $giftCard->update(['status' => GiftCardStatusEnum::EXPIRED]);
                }
            });

        $this->info('Expired gift cards have been updated.');
    }
}
