<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseReturnItemResource\Pages;
use App\Models\PurchaseReturnItem;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;

class PurchaseReturnItemResource extends Resource
{
    protected static ?string $model = PurchaseReturnItem::class;
    protected static ?string $navigationIcon = 'heroicon-o-arrow-uturn-left';
    protected static ?string $navigationGroup = 'Pembelian';
    protected static ?string $navigationLabel = 'Detail Retur Pembelian';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Select::make('purchase_return_id')
                ->relationship('purchaseReturn', 'id')
                ->required()
                ->label('No Retur'),

            Forms\Components\Select::make('item_id')
                ->relationship('item', 'name')
                ->required()
                ->label('Barang'),

            Forms\Components\Select::make('unit_id')
                ->relationship('unit', 'name')
                ->required()
                ->label('Satuan'),

            Forms\Components\TextInput::make('qty')
                ->numeric()
                ->required()
                ->label('Qty Retur'),

            Forms\Components\TextInput::make('purchase_price')
                ->numeric()
                ->required()
                ->label('Harga Beli'),

            Forms\Components\TextInput::make('discount_percent')
                ->numeric()
                ->label('Diskon (%)'),

            Forms\Components\TextInput::make('discount_amount')
                ->numeric()
                ->label('Diskon Nominal'),

            Forms\Components\TextInput::make('total')
                ->numeric()
                ->required()
                ->label('Total'),

            Forms\Components\Textarea::make('reason')
                ->label('Alasan Retur')
                ->rows(2),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('purchaseReturn.id')->label('No Retur'),
                Tables\Columns\TextColumn::make('item.name')->label('Barang'),
                Tables\Columns\TextColumn::make('unit.name')->label('Satuan'),
                Tables\Columns\TextColumn::make('qty'),
                Tables\Columns\TextColumn::make('purchase_price')->money('IDR'),
                Tables\Columns\TextColumn::make('discount_percent'),
                Tables\Columns\TextColumn::make('discount_amount')->money('IDR'),
                Tables\Columns\TextColumn::make('total')->money('IDR'),
                Tables\Columns\TextColumn::make('reason')->limit(30),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y H:i'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPurchaseReturnItems::route('/'),
            'create' => Pages\CreatePurchaseReturnItem::route('/create'),
            'edit' => Pages\EditPurchaseReturnItem::route('/{record}/edit'),
        ];
    }
}
