<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerAccountResource\Pages;
use App\Models\CustomerAccount;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CustomerAccountResource extends Resource
{
    protected static ?string $model = CustomerAccount::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Customers';
    protected static ?string $navigationLabel = 'Customer Accounts';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->label('Customer')
                    ->required(),

                Forms\Components\TextInput::make('bank_name')
                    ->label('Nama Bank')
                    ->maxLength(100)
                    ->required(),

                Forms\Components\TextInput::make('account_number')
                    ->label('Nomor Rekening')
                    ->maxLength(50)
                    ->required(),

                Forms\Components\TextInput::make('account_holder')
                    ->label('Atas Nama')
                    ->maxLength(100)
                    ->required(),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Customer')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('bank_name')
                    ->label('Bank')
                    ->sortable(),

                Tables\Columns\TextColumn::make('account_number')
                    ->label('No. Rekening'),

                Tables\Columns\TextColumn::make('account_holder')
                    ->label('Atas Nama'),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Aktif'),
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
            'index' => Pages\ListCustomerAccounts::route('/'),
            'create' => Pages\CreateCustomerAccount::route('/create'),
            'edit' => Pages\EditCustomerAccount::route('/{record}/edit'),
        ];
    }
}
