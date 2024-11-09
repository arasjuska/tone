<?php

namespace App\Filament\Resources;

use App\Enums\ExpirationPeriodEnum;
use App\Enums\GiftCardStatusEnum;
use App\Filament\Resources\GiftCardResource\Pages;
use App\Filament\Resources\GiftCardResource\RelationManagers\GiftCardRedemptionsRelationManager;
use App\Models\GiftCards\GiftCard;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GiftCardResource extends Resource
{
    protected static ?string $model = GiftCard::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make([
                        Forms\Components\Select::make('status')
                            ->label(__('Status'))
                            ->options(GiftCardStatusEnum::class)
                            ->required()
                            ->hiddenOn('create'),

                        Forms\Components\Select::make('expiration_months')
                            ->label(__('Expiration months'))
                            ->options(ExpirationPeriodEnum::class)
                            ->required(),

                        Forms\Components\TextInput::make('amount')
                            ->label(__('Amount'))
                            ->required()
                            ->numeric()
                            ->minValue(5.00)
                            ->step(5)
                            ->default(0.00),

                        Forms\Components\TextInput::make('email')
                            ->label(__('Email'))
                            ->email()
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email_gift')
                            ->label(__("Recipient's email"))
                            ->reactive()
                            ->email()
                            ->maxLength(255)
                            ->requiredIf('gift', true)
                            ->markAsRequired()
                            ->hidden(fn($get) => !$get('gift')),
                    ]),
                    Section::make([
                        Forms\Components\Toggle::make('gift')
                            ->label(__('Gift') . '?')
                            ->reactive()
                            ->default(fn($get) => !empty($get('email_gift'))),
                    ])->grow(false),
                ])->from('md'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_gift')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->sortable(),
                Tables\Columns\TextColumn::make('remaining_amount')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('Status'))
                    ->badge(),
                Tables\Columns\TextColumn::make('expires_at')
                    ->label(__('Expires at')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('manage')
                    ->label(__('Manage'))
                    ->icon('heroicon-s-eye')
                    ->color('gray')
                    ->url(fn($record): string => route(
                        'filament.admin.resources.gift-cards.manage', [
                        'record' => $record,
                        'code' => $record->code,
                    ],
                    )),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            GiftCardRedemptionsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGiftCards::route('/'),
            'create' => Pages\CreateGiftCard::route('/create'),
            'edit' => Pages\EditGiftCard::route('/{record}/edit'),
            'manage' => Pages\ManageGiftCard::route('/{record}/manage/{code}'),
        ];
    }
}
