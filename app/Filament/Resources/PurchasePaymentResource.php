<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchasePaymentResource\Pages;
use App\Models\PurchasePayment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PurchasePaymentResource extends Resource
{
    protected static ?string $model = PurchasePayment::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Pembelian';
    protected static ?string $navigationLabel = 'Pembayaran Hutang';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('payment_no')
                    ->label('Nomor Pembayaran')
                    ->required()
                    ->maxLength(50),
                Forms\Components\Select::make('supplier_id')
                    ->relationship('supplier', 'name')
                    ->required(),
                Forms\Components\Select::make('branch_id')
                    ->relationship('branch', 'name')
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\DatePicker::make('payment_date')
                    ->label('Tanggal Pembayaran')
                    ->required(),
                Forms\Components\TextInput::make('total_paid')
                    ->label('Total Dibayar')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
                Forms\Components\Select::make('payment_method')
                    ->options([
                        'CASH' => 'Cash',
                        'BANK_TRANSFER' => 'Bank Transfer',
                        'GIRO' => 'Giro',
                        'OTHERS' => 'Lainnya',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('bank_name')
                    ->label('Nama Bank')
                    ->maxLength(100)
                    ->visible(fn ($get) => $get('payment_method') === 'BANK_TRANSFER'),
                Forms\Components\Textarea::make('note')
                    ->label('Catatan')
                    ->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->options([
                        'DRAFT' => 'Draft',
                        'POSTED' => 'Posted',
                        'CANCELLED' => 'Cancelled',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('payment_no')->label('No Pembayaran')->searchable(),
                Tables\Columns\TextColumn::make('supplier.name')->label('Supplier'),
                Tables\Columns\TextColumn::make('branch.name')->label('Cabang'),
                Tables\Columns\TextColumn::make('payment_date')->label('Tanggal')->date(),
                Tables\Columns\TextColumn::make('total_paid')->money('IDR', true),
                Tables\Columns\BadgeColumn::make('payment_method')->label('Metode'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'DRAFT',
                        'success' => 'POSTED',
                        'danger' => 'CANCELLED',
                    ]),
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
            'index' => Pages\ListPurchasePayments::route('/'),
            'create' => Pages\CreatePurchasePayment::route('/create'),
            'edit' => Pages\EditPurchasePayment::route('/{record}/edit'),
        ];
    }
}
