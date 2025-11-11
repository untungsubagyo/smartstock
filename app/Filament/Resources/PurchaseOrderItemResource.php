<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseOrderItemResource\Pages;
use App\Models\PurchaseOrderItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PurchaseOrderItemResource extends Resource
{
    protected static ?string $model = PurchaseOrderItem::class;
    protected static ?string $navigationLabel = 'PO Items';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard'; // icon aman
    protected static ?string $navigationGroup = 'Pembelian';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('purchase_order_id')
                ->relationship('purchaseOrder', 'po_number')
                ->required(),
            Forms\Components\Select::make('item_id')
                ->relationship('item', 'name')
                ->required(),
            Forms\Components\Select::make('unit_id')
                ->relationship('unit', 'name')
                ->required(),
            Forms\Components\TextInput::make('qty')->numeric()->required(),
            Forms\Components\TextInput::make('purchase_price')->numeric()->required(),
            Forms\Components\TextInput::make('discount_percent')->numeric()->default(0),
            Forms\Components\TextInput::make('discount_amount')->numeric()->default(0),
            Forms\Components\TextInput::make('net_price')->numeric()->required(),
            Forms\Components\TextInput::make('total')->numeric()->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('purchaseOrder.po_number')->label('PO')->sortable(),
            Tables\Columns\TextColumn::make('item.name')->label('Barang')->sortable(),
            Tables\Columns\TextColumn::make('unit.name')->label('Satuan'),
            Tables\Columns\TextColumn::make('qty')->numeric(),
            Tables\Columns\TextColumn::make('purchase_price')->money('idr', true),
            Tables\Columns\TextColumn::make('discount_percent')->suffix('%'),
            Tables\Columns\TextColumn::make('discount_amount')->money('idr', true),
            Tables\Columns\TextColumn::make('net_price')->money('idr', true),
            Tables\Columns\TextColumn::make('total')->money('idr', true),
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPurchaseOrderItems::route('/'),
            'create' => Pages\CreatePurchaseOrderItem::route('/create'),
            'edit' => Pages\EditPurchaseOrderItem::route('/{record}/edit'),
        ];
    }
}
