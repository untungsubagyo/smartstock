<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccountBalanceResource\Pages;
use App\Models\AccountBalance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;

class AccountBalanceResource extends Resource
{
    protected static ?string $model = AccountBalance::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Akuntansi';
    protected static ?string $navigationLabel = 'Saldo Akun';
    protected static ?string $modelLabel = 'Saldo Akun';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('account_id')
                ->relationship('account', 'name')
                ->required()
                ->label('Akun'),

            Forms\Components\TextInput::make('period')
                ->required()
                ->label('Periode (YYYY-MM)')
                ->maxLength(7)
                ->helperText('Gunakan format: 2025-11'),

            Forms\Components\TextInput::make('opening_balance')
                ->numeric()
                ->default(0)
                ->label('Saldo Awal'),

            Forms\Components\TextInput::make('debit_total')
                ->numeric()
                ->default(0)
                ->label('Total Debit'),

            Forms\Components\TextInput::make('credit_total')
                ->numeric()
                ->default(0)
                ->label('Total Kredit'),

            Forms\Components\TextInput::make('closing_balance')
                ->numeric()
                ->default(0)
                ->label('Saldo Akhir'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('account.name')
                    ->label('Akun')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('period')
                    ->label('Periode')
                    ->sortable(),

                Tables\Columns\TextColumn::make('opening_balance')
                    ->money('IDR', true)
                    ->label('Saldo Awal'),

                Tables\Columns\TextColumn::make('debit_total')
                    ->money('IDR', true)
                    ->label('Total Debit'),

                Tables\Columns\TextColumn::make('credit_total')
                    ->money('IDR', true)
                    ->label('Total Kredit'),

                Tables\Columns\TextColumn::make('closing_balance')
                    ->money('IDR', true)
                    ->label('Saldo Akhir'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->label('Dibuat'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
           ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);

    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAccountBalances::route('/'),
            'create' => Pages\CreateAccountBalance::route('/create'),
            'edit' => Pages\EditAccountBalance::route('/{record}/edit'),
        ];
    }
}
