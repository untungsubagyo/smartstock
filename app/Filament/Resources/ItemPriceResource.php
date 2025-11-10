<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemPriceResource\Pages;
use App\Models\ItemPrice;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;

class ItemPriceResource extends Resource
{
    protected static ?string $model = ItemPrice::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Item Prices';
    protected static ?string $pluralLabel = 'Item Prices';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('item_id')
                    ->relationship('item', 'name')
                    ->label('Item')
                    ->required(),

                Forms\Components\TextInput::make('min_qty')
                    ->label('Minimal Qty')
                    ->numeric()
                    ->default(1)
                    ->required(),

                Forms\Components\TextInput::make('margin')
                    ->label('Margin (%)')
                    ->numeric()
                    ->suffix('%'),

                Forms\Components\TextInput::make('sale_price')
                    ->label('Harga Jual Grosir')
                    ->numeric()
                    ->prefix('Rp'),

                Forms\Components\Textarea::make('notes')
                    ->label('Catatan')
                    ->rows(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('item.name')->label('Item'),
                Tables\Columns\TextColumn::make('min_qty')->label('Minimal Qty'),
                Tables\Columns\TextColumn::make('margin')->label('Margin (%)'),
                Tables\Columns\TextColumn::make('sale_price')->money('IDR', true)->label('Harga Grosir'),
                Tables\Columns\TextColumn::make('notes')->limit(20)->label('Catatan'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListItemPrices::route('/'),
            'create' => Pages\CreateItemPrice::route('/create'),
            'edit' => Pages\EditItemPrice::route('/{record}/edit'),
        ];
    }
}
