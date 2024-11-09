<?php

namespace App\Filament\Resources\GiftCardResource\Pages;

use App\Enums\GiftCardStatusEnum;
use App\Filament\Resources\GiftCardResource;
use App\Models\GiftCards\GiftCardRedemption;
use App\Services\GiftCardService;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ManageGiftCard extends ViewRecord
{
    protected static string $resource = GiftCardResource::class;

    public function getHeading(): string
    {
        return __('Manage Gift Card');
    }

    public function getBreadcrumb(): string
    {
        return __('Manage');
    }

    protected function getHeaderActions(): array
    {
        return !$this->record->isValid
            ? []
            : [
                \Filament\Actions\Action::make('sendPdf')
                    ->color('success')
                    ->action(fn() => (new GiftCardService($this->record))->generatePdf()),
            ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make()
                    ->schema([
                        Grid::make()
                            ->schema([
                                Group::make([
                                    Fieldset::make('status')
                                        ->hiddenLabel()
                                        ->schema([
                                            TextEntry::make('status')
                                                ->label(__('Status'))
                                                ->badge(),
                                            TextEntry::make('expires_at')
                                                ->label(__('Expires at')),
                                            TextEntry::make('amount')
                                                ->label(__('Amount'))
                                                //TODO: fix hardcoded currency & locale
                                                ->money(currency: 'EUR', locale: 'lt')
                                                ->badge()
                                                ->color('gray'),
                                            TextEntry::make('code')
                                                ->label(__('Code')),
                                        ]),
                                    Fieldset::make('email')
                                        ->hiddenLabel()
                                        ->schema([
                                            TextEntry::make('email')
                                                ->label(__('Email')),
                                            TextEntry::make('email_gift')
                                                ->label(__('Gift'))
                                                ->visible(fn($record) => $record->email_gift),
                                        ]),
                                ]),

                                Group::make([
                                    Fieldset::make('enter_used_amount')
                                        ->label(__('Enter used amount'))
                                        ->schema([
                                            TextEntry::make('remaining_amount')
                                                ->label(__('Remaining amount'))
                                                //TODO: fix hardcoded currency & locale
                                                ->money(currency: 'EUR', locale: 'lt')
                                                ->badge()
                                                ->color('info')
                                                ->hintAction(
                                                    Action::make('enter_used_amount')
                                                        ->label(__('Enter'))
                                                        ->form([
                                                            TextInput::make('amount')
                                                                ->label(__('Amount'))
                                                                ->numeric()
                                                                ->minValue(1)
                                                                ->maxValue(fn($record) => $record->remaining_amount)
                                                                ->required(),
                                                        ])
                                                        ->icon('heroicon-m-pencil-square')
                                                        ->requiresConfirmation()
                                                        ->action(function ($record, array $data) {
                                                            $statusBefore = $record->status;
                                                            $record->remaining_amount -= $data['amount'];
                                                            $record->status = (int)$record->remaining_amount === 0
                                                                ? GiftCardStatusEnum::REDEEMED
                                                                : GiftCardStatusEnum::PARTIALLY_REDEEMED;

                                                            $record->save();

                                                            GiftCardRedemption::create([
                                                                'gift_card_id' => $record->id,
                                                                'redeemed_by' => auth()->id(),
                                                                'status_before' => $statusBefore,
                                                                'status_after' => $record->status,
                                                                'redeemed_amount' => $data['amount'],
                                                            ]);
                                                        })
                                                        ->after(fn($livewire) => $livewire->dispatch('giftCardRedemptionsRelationManager:refresh'))
                                                        ->hidden(fn($record) => !$record->isValid)
                                                        ->modalDescription(__('Deduct a specified amount from the gift card’s remaining balance, limited to the available balance.'))
                                                )
                                        ]),
                                ]),
                            ]),
                    ]),
            ]);
    }
}
