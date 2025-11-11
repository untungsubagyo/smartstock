<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SalesDetailResource\Pages;
use App\Models\SalesDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SalesDetailResource extends Resource
{
    protected static ?string $model = SalesDetail::class;
    protected static ?string $navigationLabel = 'Detail Penjualan';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard';
    protected static ?string $navigationGroup = 'Transaksi';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('sale_id')
                ->label('Transaksi')
                ->relationship('sale', 'invoice_no')
                ->required(),
            Forms\Components\Select::make('item_id')
                ->label('Barang')
                ->relationship('item', 'name')
                ->required(),
            Forms\Components\Select::make('variant_id')
                ->label('Varian')
                ->relationship('variant', 'name')
                ->nullable(),
            Forms\Components\TextInput::make('barcode')->required()->maxLength(100),
            Forms\Components\TextInput::make('item_name')->required()->maxLength(150),
            Forms\Components\TextInput::make('qty')->numeric()->required(),
            Forms\Components\Select::make('unit_id')
                ->label('Satuan')
                ->relationship('unit', 'name')
                ->required(),
            Forms\Components\TextInput::make('price')->numeric()->required(),
            Forms\Components\TextInput::make('discount_percent')->numeric()->default(0),
            Forms\Components\TextInput::make('discount_amount')->numeric()->default(0),
            Forms\Components\TextInput::make('tax_percent')->numeric()->default(0),
            Forms\Components\TextInput::make('tax_amount')->numeric()->default(0),
            Forms\Components\TextInput::make('total')->numeric()->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('sale.invoice_no')->label('Transaksi')->sortable(),
            Tables\Columns\TextColumn::make('item_name')->label('Barang')->sortable(),
            Tables\Columns\TextColumn::make('variant.name')->label('Varian')->sortable(),
            Tables\Columns\TextColumn::make('qty')->sortable(),
            Tables\Columns\TextColumn::make('unit.name')->label('Satuan')->sortable(),
            Tables\Columns\TextColumn::make('price')->money('idr', true),
            Tables\Columns\TextColumn::make('discount_amount')->money('idr', true),
            Tables\Columns\TextColumn::make('tax_amount')->money('idr', true),
            Tables\Columns\TextColumn::make('total')->money('idr', true)->sortable(),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSalesDetails::route('/'),
            'create' => Pages\CreateSalesDetail::route('/create'),
            'edit' => Pages\EditSalesDetail::route('/{record}/edit'),
        ];
    }
}
