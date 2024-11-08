<?php

namespace App\Filament\Resources\GiftCardResource\Pages;

use App\Filament\Resources\GiftCardResource;
use App\Services\GiftCardService;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditGiftCard extends EditRecord
{
    protected static string $resource = GiftCardResource::class;

    protected function getHeaderActions(): array
    {
        $actions = [
            Actions\DeleteAction::make(),
        ];

        $this->record->is_valid && $actions[] = Actions\Action::make('sendPdf')
            ->color('success')
            ->action(fn() => (new GiftCardService($this->record))->generatePdf());

        return $actions;
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
