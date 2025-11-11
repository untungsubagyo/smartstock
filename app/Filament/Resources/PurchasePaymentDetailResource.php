<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchasePaymentDetailResource\Pages;
use App\Models\PurchasePaymentDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PurchasePaymentDetailResource extends Resource
{
    protected static ?string $model = PurchasePaymentDetail::class;
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationGroup = 'Pembelian';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('purchase_payment_id')
                ->relationship('purchasePayment', 'payment_no')
                ->required(),
            Forms\Components\Select::make('purchase_id')
                ->relationship('purchase', 'invoice_no')
                ->required(),
            Forms\Components\TextInput::make('amount')
                ->numeric()
                ->required()
                ->prefix('Rp'),
            Forms\Components\TextInput::make('remaining')
                ->numeric()
                ->required()
                ->prefix('Rp'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('purchasePayment.payment_no')->label('No Pembayaran'),
                Tables\Columns\TextColumn::make('purchase.invoice_no')->label('No Faktur'),
                Tables\Columns\TextColumn::make('amount')->money('IDR', true),
                Tables\Columns\TextColumn::make('remaining')->money('IDR', true),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
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
            'index' => Pages\ListPurchasePaymentDetails::route('/'),
            'create' => Pages\CreatePurchasePaymentDetail::route('/create'),
            'edit' => Pages\EditPurchasePaymentDetail::route('/{record}/edit'),
        ];
    }
}
