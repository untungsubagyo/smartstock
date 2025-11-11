<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CashTransactionResource\Pages;
use App\Models\CashTransaction;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;

class CashTransactionResource extends Resource
{
    protected static ?string $model = CashTransaction::class;
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Kas & Bank';
    protected static ?string $navigationLabel = 'Transaksi Kas';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('transaction_no')
                    ->label('Nomor Transaksi')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(50),

                Forms\Components\DatePicker::make('transaction_date')
                    ->label('Tanggal Transaksi')
                    ->required(),

                Forms\Components\DatePicker::make('entry_date')
                    ->label('Tanggal Input')
                    ->default(now())
                    ->required(),

                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Petugas')
                    ->required(),

                Forms\Components\TextInput::make('transaction_name')
                    ->label('Nama Transaksi')
                    ->required()
                    ->maxLength(150),

                Forms\Components\Select::make('transaction_type')
                    ->options([
                        'CASH_IN' => 'Masuk',
                        'CASH_OUT' => 'Keluar',
                    ])
                    ->required()
                    ->label('Jenis Transaksi'),

                Forms\Components\TextInput::make('amount')
                    ->numeric()
                    ->label('Jumlah')
                    ->required(),

                Forms\Components\Textarea::make('note')
                    ->label('Keterangan')
                    ->maxLength(65535),

                Forms\Components\Select::make('status')
                    ->options([
                        'DRAFT' => 'Draft',
                        'POSTED' => 'Posted',
                    ])
                    ->default('DRAFT')
                    ->label('Status'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transaction_no')->label('No. Transaksi')->searchable(),
                Tables\Columns\TextColumn::make('transaction_date')->date('d M Y'),
                Tables\Columns\TextColumn::make('entry_date')->date('d M Y'),
                Tables\Columns\TextColumn::make('user.name')->label('Petugas'),
                Tables\Columns\TextColumn::make('transaction_name'),
                Tables\Columns\BadgeColumn::make('transaction_type')
                    ->label('Jenis')
                    ->colors([
                        'success' => 'CASH_IN',
                        'danger' => 'CASH_OUT',
                    ]),
                Tables\Columns\TextColumn::make('amount')->money('IDR'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'gray' => 'DRAFT',
                        'success' => 'POSTED',
                    ]),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y H:i'),
            ])
            ->defaultSort('transaction_date', 'desc')
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()->visible(fn ($record) => $record->status === 'DRAFT'),
                Tables\Actions\DeleteAction::make()->visible(fn ($record) => $record->status === 'DRAFT'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCashTransactions::route('/'),
            'create' => Pages\CreateCashTransaction::route('/create'),
            'edit' => Pages\EditCashTransaction::route('/{record}/edit'),
            // 'view' => Pages\ViewCashTransaction::route('/{record}'),
        ];
    }
}
