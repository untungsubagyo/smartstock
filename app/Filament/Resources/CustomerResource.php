<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Customers';
    protected static ?string $pluralLabel = 'Customers';
    protected static ?string $slug = 'customers';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->label('Kode Customer')
                    ->disabled()
                    ->default(fn () => 'CUS-' . strtoupper(uniqid())),

                Forms\Components\TextInput::make('name')
                    ->label('Nama Customer')
                    ->required(),

                Forms\Components\Textarea::make('address')
                    ->label('Alamat')
                    ->nullable(),

                Forms\Components\TextInput::make('district')
                    ->label('Kecamatan')
                    ->nullable(),

                Forms\Components\TextInput::make('phone')
                    ->label('Telepon')
                    ->nullable(),

                Forms\Components\TextInput::make('mobile')
                    ->label('HP')
                    ->nullable(),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->nullable(),

                Forms\Components\Select::make('customer_type')
                    ->label('Tipe Customer')
                    ->options([
                        'retail' => 'Retail',
                        'wholesale' => 'Wholesale',
                        'vip' => 'VIP',
                        'member' => 'Member',
                    ])
                    ->default('retail'),

                Forms\Components\Select::make('wholesale_price_type')
                    ->label('Tipe Harga Grosir')
                    ->options([
                        'NORMAL' => 'NORMAL',
                        'GROSIR1' => 'GROSIR1',
                        'GROSIR2' => 'GROSIR2',
                        'GROSIR3' => 'GROSIR3',
                        'GROSIR4' => 'GROSIR4',
                    ])
                    ->default('NORMAL'),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'AKTIF' => 'Aktif',
                        'NONAKTIF' => 'Non Aktif',
                    ])
                    ->default('AKTIF'),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('customer_type')
                    ->label('Tipe'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
