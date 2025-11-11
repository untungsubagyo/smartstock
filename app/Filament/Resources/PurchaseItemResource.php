<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseItemResource\Pages;
use App\Models\PurchaseItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PurchaseItemResource extends Resource
{
    protected static ?string $model = PurchaseItem::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Pembelian';
    protected static ?string $navigationLabel = 'Purchase Items';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('purchase_id')
                ->relationship('purchase', 'id')
                ->label('Purchase')
                ->required(),

            Forms\Components\Select::make('item_id')
                ->relationship('item', 'name')
                ->label('Item')
                ->required(),

            Forms\Components\Select::make('unit_id')
                ->relationship('unit', 'name')
                ->label('Unit')
                ->required(),

            Forms\Components\TextInput::make('qty')
                ->numeric()
                ->label('Quantity')
                ->required(),

            Forms\Components\TextInput::make('price')
                ->numeric()
                ->label('Harga Beli Satuan')
                ->required(),

            Forms\Components\TextInput::make('discount_percent')
                ->numeric()
                ->label('Diskon (%)'),

            Forms\Components\TextInput::make('discount_amount')
                ->numeric()
                ->label('Diskon Nominal'),

            Forms\Components\Select::make('discount_type')
                ->options([
                    'percent' => 'Persen',
                    'amount' => 'Nominal',
                    'none' => 'Tidak Ada',
                ])
                ->default('none')
                ->label('Tipe Diskon'),

            Forms\Components\TextInput::make('net_price')
                ->numeric()
                ->label('Harga Bersih per Unit'),

            Forms\Components\TextInput::make('subtotal')
                ->numeric()
                ->label('Subtotal'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('purchase.id')->label('Purchase'),
                Tables\Columns\TextColumn::make('item.name')->label('Item'),
                Tables\Columns\TextColumn::make('unit.name')->label('Unit'),
                Tables\Columns\TextColumn::make('qty')->label('Qty'),
                Tables\Columns\TextColumn::make('price')->money('IDR')->label('Harga'),
                Tables\Columns\TextColumn::make('subtotal')->money('IDR')->label('Subtotal'),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y H:i')->label('Dibuat'),
            ])
            ->filters([])
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
            'index' => Pages\ListPurchaseItems::route('/'),
            'create' => Pages\CreatePurchaseItem::route('/create'),
            'edit' => Pages\EditPurchaseItem::route('/{record}/edit'),
        ];
    }
}
