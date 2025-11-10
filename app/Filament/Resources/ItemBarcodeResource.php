<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemBarcodeResource\Pages;
use App\Models\ItemBarcode;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;

class ItemBarcodeResource extends Resource
{
    protected static ?string $model = ItemBarcode::class;

    protected static ?string $navigationIcon = 'heroicon-o-qr-code';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Item Barcodes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('item_id')
                    ->relationship('item', 'name')
                    ->label('Item')
                    ->required(),

                Forms\Components\TextInput::make('barcode')
                    ->label('Barcode Alternatif')
                    ->maxLength(100)
                    ->unique(ignoreRecord: true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('item.name')->label('Item'),
                Tables\Columns\TextColumn::make('barcode')->label('Barcode Alternatif'),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d/m/Y')->label('Dibuat'),
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
            'index' => Pages\ListItemBarcodes::route('/'),
            'create' => Pages\CreateItemBarcode::route('/create'),
            'edit' => Pages\EditItemBarcode::route('/{record}/edit'),
        ];
    }
}
