<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemBarcodePriceResource\Pages;
use App\Models\ItemBarcodePrice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ItemBarcodePriceResource extends Resource
{
    protected static ?string $model = ItemBarcodePrice::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Harga Jual Barcode';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('item_id')
                    ->relationship('item', 'name')
                    ->label('Item')
                    ->required()
                    ->searchable(),

                Forms\Components\TextInput::make('barcode')
                    ->label('Barcode')
                    ->required()
                    ->maxLength(100),

                Forms\Components\Select::make('unit_id')
                    ->relationship('unit', 'name')
                    ->label('Unit')
                    ->required()
                    ->searchable(),

                Forms\Components\TextInput::make('qty_pcs')
                    ->label('Qty ke PCS')
                    ->numeric()
                    ->default(1)
                    ->required(),

                Forms\Components\TextInput::make('hpp')
                    ->label('HPP (Rp)')
                    ->numeric()
                    ->prefix('Rp')
                    ->reactive()
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        $hpp = (float) $get('hpp');
                        $margin = (float) $get('margin');
                        $set('sale_price', $hpp + ($hpp * $margin / 100));
                    }),

                Forms\Components\TextInput::make('margin')
                    ->label('Margin (%)')
                    ->numeric()
                    ->suffix('%')
                    ->reactive()
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        $hpp = (float) $get('hpp');
                        $margin = (float) $get('margin');
                        $set('sale_price', $hpp + ($hpp * $margin / 100));
                    }),

                Forms\Components\TextInput::make('sale_price')
                    ->label('Harga Jual (Rp)')
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
                Tables\Columns\TextColumn::make('item.name')
                    ->label('Item')
                    ->searchable(),
                Tables\Columns\TextColumn::make('barcode')
                    ->label('Barcode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('unit.name')
                    ->label('Unit'),
                Tables\Columns\TextColumn::make('qty_pcs')
                    ->label('Qty/PCS'),
                Tables\Columns\TextColumn::make('hpp')
                    ->label('HPP')
                    ->money('IDR', true),
                Tables\Columns\TextColumn::make('margin')
                    ->label('Margin (%)'),
                Tables\Columns\TextColumn::make('sale_price')
                    ->label('Harga Jual')
                    ->money('IDR', true),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Aktif'),
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
            'index' => Pages\ListItemBarcodePrices::route('/'),
            'create' => Pages\CreateItemBarcodePrice::route('/create'),
            'edit' => Pages\EditItemBarcodePrice::route('/{record}/edit'),
        ];
    }
}
