<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerAddressResource\Pages;
use App\Models\CustomerAddress;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CustomerAddressResource extends Resource
{
    protected static ?string $model = CustomerAddress::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationGroup = 'Customers';
    protected static ?string $navigationLabel = 'Customer Addresses';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->label('Customer')
                    ->required(),

                Forms\Components\TextInput::make('label')
                    ->label('Label / Nama Penerima')
                    ->maxLength(100)
                    ->required(),

                Forms\Components\Textarea::make('address')
                    ->label('Alamat Lengkap')
                    ->rows(3)
                    ->required(),

                Forms\Components\TextInput::make('city')
                    ->label('Kota / Kabupaten')
                    ->maxLength(100)
                    ->required(),

                Forms\Components\TextInput::make('province')
                    ->label('Provinsi')
                    ->maxLength(100)
                    ->nullable(),

                Forms\Components\TextInput::make('phone')
                    ->label('Telepon')
                    ->maxLength(30)
                    ->required(),

                Forms\Components\Toggle::make('is_default')
                    ->label('Alamat Utama?')
                    ->default(false),
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

                Tables\Columns\TextColumn::make('label')
                    ->label('Label'),

                Tables\Columns\TextColumn::make('city')
                    ->label('Kota'),

                Tables\Columns\TextColumn::make('province')
                    ->label('Provinsi'),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Telepon'),

                Tables\Columns\IconColumn::make('is_default')
                    ->boolean()
                    ->label('Default'),
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
            'index' => Pages\ListCustomerAddresses::route('/'),
            'create' => Pages\CreateCustomerAddress::route('/create'),
            'edit' => Pages\EditCustomerAddress::route('/{record}/edit'),
        ];
    }
}
