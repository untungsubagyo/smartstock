<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemExtraCostResource\Pages;
use App\Models\ItemExtraCost;
use App\Models\Item;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ItemExtraCostResource extends Resource
{
    protected static ?string $model = ItemExtraCost::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationGroup = 'Items Management';
    protected static ?string $navigationLabel = 'Item Extra Costs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('item_id')
                    ->label('Item')
                    ->options(Item::pluck('name', 'id'))
                    ->required()
                    ->searchable(),

                Forms\Components\TextInput::make('name')
                    ->label('Nama Biaya')
                    ->required()
                    ->maxLength(100),

                Forms\Components\TextInput::make('amount')
                    ->label('Nilai Tambahan')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('item.name')->label('Item'),
                Tables\Columns\TextColumn::make('name')->label('Nama Biaya')->searchable(),
                Tables\Columns\TextColumn::make('amount')->label('Nilai Tambahan')->money('IDR', true),
                Tables\Columns\IconColumn::make('is_active')->label('Aktif')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->label('Dibuat'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')->label('Status Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListItemExtraCosts::route('/'),
            'create' => Pages\CreateItemExtraCost::route('/create'),
            'edit' => Pages\EditItemExtraCost::route('/{record}/edit'),
        ];
    }
}
