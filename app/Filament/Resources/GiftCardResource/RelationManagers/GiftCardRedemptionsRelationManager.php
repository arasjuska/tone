<?php

namespace App\Filament\Resources\GiftCardResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class GiftCardRedemptionsRelationManager extends RelationManager
{
    protected static string $relationship = 'giftCardRedemptions';

    protected $listeners = ['giftCardRedemptionsRelationManager:refresh' => '$refresh'];

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('gift_card_id')
            ->columns([
                Tables\Columns\TextColumn::make('index')
                    ->label('#')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('redeemedBy.name'),
                Tables\Columns\TextColumn::make('redeemed_amount'),
                Tables\Columns\TextColumn::make('status_before')
                    ->badge(),
                Tables\Columns\TextColumn::make('status_after')
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Redeem date'))
                    ->dateTime('Y-m-d'),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
