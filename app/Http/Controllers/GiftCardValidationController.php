<?php

namespace App\Http\Controllers;

use App\Models\GiftCards\GiftCard;
use Filament\Notifications\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class GiftCardValidationController extends Controller
{
    public function validateGiftCard(GiftCard $record, $token): RedirectResponse
    {
        if (!$record->token || $record->token_expire_at < now()) {
            Notification::make()
                ->title('Invalid or expired token 1')
                ->danger()
                ->seconds(10)
                ->send();

            return redirect()->route('filament.admin.auth.login');
        }

        if (!Hash::check($token, $record->token)) {
            Notification::make()
                ->title('Invalid or expired token 2')
                ->danger()
                ->seconds(10)
                ->send();

            return redirect()->route('filament.admin.auth.login');
        }

        if (!auth()->check()) {
            Notification::make()
                ->title('Please log in to validate the gift card')
                ->danger()
                ->seconds(10)
                ->send();

            return redirect()->route('filament.admin.auth.login');
        }

        Notification::make()
            ->title('Gift card validated successfully')
            ->success()
            ->seconds(10)
            ->send();

        return redirect()->route('filament.admin.resources.gift-cards.view', $record->id);
    }
}
