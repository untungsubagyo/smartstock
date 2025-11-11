<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerReceivableResource\Pages;
use App\Models\CustomerReceivable;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CustomerReceivableResource extends Resource
{
    protected static ?string $model = CustomerReceivable::class;
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationGroup = 'Transaksi';
    protected static ?string $navigationLabel = 'Piutang Pelanggan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->required()
                    ->label('Pelanggan'),

                Forms\Components\TextInput::make('invoice_no')
                    ->required()
                    ->maxLength(50)
                    ->label('Nomor Nota'),

                Forms\Components\DatePicker::make('transaction_date')
                    ->required()
                    ->label('Tanggal Transaksi'),

                Forms\Components\DatePicker::make('due_date')
                    ->required()
                    ->label('Jatuh Tempo'),

                Forms\Components\TextInput::make('total_amount')
                    ->numeric()
                    ->required()
                    ->label('Nilai Transaksi'),

                Forms\Components\TextInput::make('paid_amount')
                    ->numeric()
                    ->default(0)
                    ->label('Sudah Dibayar'),

                Forms\Components\TextInput::make('remaining_amount')
                    ->numeric()
                    ->default(0)
                    ->label('Sisa Piutang'),

                Forms\Components\Select::make('status')
                    ->options([
                        'LUNAS' => 'Lunas',
                        'BELUM_LUNAS' => 'Belum Lunas',
                    ])
                    ->default('BELUM_LUNAS')
                    ->required()
                    ->label('Status Pembayaran'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Pelanggan')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('invoice_no')
                    ->label('Invoice'),

                Tables\Columns\TextColumn::make('transaction_date')
                    ->label('Tanggal'),

                Tables\Columns\TextColumn::make('due_date')
                    ->label('Jatuh Tempo'),

                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Total')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('paid_amount')
                    ->label('Dibayar')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('remaining_amount')
                    ->label('Sisa')
                    ->money('IDR'),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'LUNAS',
                        'danger' => 'BELUM_LUNAS',
                    ]),
            ])
            ->defaultSort('transaction_date', 'desc')
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
            'index' => Pages\ListCustomerReceivables::route('/'),
            'create' => Pages\CreateCustomerReceivable::route('/create'),
            'edit' => Pages\EditCustomerReceivable::route('/{record}/edit'),
        ];
    }
}
