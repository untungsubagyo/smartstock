<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaleResource\Pages;
use App\Models\Sale;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\table;

class SaleResource extends Resource
{
    protected static ?string $model = Sale::class;
    protected static ?string $navigationLabel = 'Penjualan';
    protected static ?string $navigationIcon = 'heroicon-o-document-text'; // pasti ada
    protected static ?string $navigationGroup = 'Transaksi';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('invoice_no')->required()->maxLength(50),
            Forms\Components\Select::make('branch_id')->relationship('branch', 'name')->required(),
            Forms\Components\Select::make('pos_station_id')->relationship('posStation', 'name')->required(),
            Forms\Components\Select::make('user_id')->relationship('user', 'name')->required(),
            Forms\Components\Select::make('customer_id')->relationship('customer', 'name')->nullable(),
            Forms\Components\DateTimePicker::make('sale_date')->required(),
            Forms\Components\TextInput::make('subtotal')->numeric()->required(),
            Forms\Components\TextInput::make('discount_amount')->numeric()->default(0),
            Forms\Components\TextInput::make('discount_percent')->numeric()->default(0),
            Forms\Components\TextInput::make('tax_amount')->numeric()->default(0),
            Forms\Components\TextInput::make('total_amount')->numeric()->required(),
            Forms\Components\Select::make('payment_method')->options([
                'CASH' => 'CASH',
                'TRANSFER' => 'TRANSFER',
                'EWALLET' => 'EWALLET',
                'CREDIT' => 'CREDIT'
            ])->required(),
            Forms\Components\TextInput::make('amount_paid')->numeric()->default(0),
            Forms\Components\TextInput::make('change_amount')->numeric()->default(0),
            Forms\Components\Textarea::make('note')->nullable(),
            Forms\Components\Select::make('status')->options([
                'PAID' => 'PAID',
                'CREDIT' => 'CREDIT',
                'CANCELLED' => 'CANCELLED',
                'REFUND' => 'REFUND'
            ])->required(),
            Forms\Components\Select::make('sync_status')->options([
                'PENDING' => 'PENDING',
                'SYNCED' => 'SYNCED',
                'FAILED' => 'FAILED'
            ])->default('PENDING')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('invoice_no')->searchable(),
            Tables\Columns\TextColumn::make('branch.name')->label('Cabang')->sortable(),
            Tables\Columns\TextColumn::make('posStation.name')->label('Kasir')->sortable(),
            Tables\Columns\TextColumn::make('customer.name')->label('Pelanggan')->sortable(),
            Tables\Columns\TextColumn::make('total_amount')->money('idr', true)->sortable(),
            Tables\Columns\TextColumn::make('sale_date')->dateTime()->sortable(),
            Tables\Columns\TextColumn::make('status')->sortable(),
        ])->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
        ])->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSales::route('/'),
            'create' => Pages\CreateSale::route('/create'),
            'edit' => Pages\EditSale::route('/{record}/edit'),
        ];
    }
}
