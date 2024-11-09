<?php

namespace App\Filament\Resources\GiftCardResource\Pages;

use App\Filament\Resources\GiftCardResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGiftCard extends EditRecord
{
    protected static string $resource = GiftCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['gift'] = $this->isGiftEmailProvided($data['email_gift']);

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (!$data['gift']) {
            $data['email_gift'] = null;
        }

        return $data;
    }

    private function isGiftEmailProvided(?string $emailGift): bool
    {
        return !empty($emailGift);
    }
}
