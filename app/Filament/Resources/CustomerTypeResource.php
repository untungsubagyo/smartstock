<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerTypeResource\Pages;
use App\Models\CustomerType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CustomerTypeResource extends Resource
{
    protected static ?string $model = CustomerType::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Jenis Customer';
    protected static ?string $pluralModelLabel = 'Jenis Customer';
    protected static ?string $slug = 'customer-types';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('code')
                ->label('Kode')
                ->maxLength(10)
                ->required(),

            Forms\Components\TextInput::make('name')
                ->label('Nama Jenis Customer')
                ->maxLength(100)
                ->required(),

            Forms\Components\TextInput::make('discount_percent')
                ->label('Diskon (%)')
                ->numeric()
                ->default(0),

            Forms\Components\TextInput::make('min_total_sales')
                ->label('Minimal Total Penjualan')
                ->numeric()
                ->default(0),

            Forms\Components\Select::make('status')
                ->options([
                    'AKTIF' => 'Aktif',
                    'NONAKTIF' => 'Nonaktif',
                ])
                ->default('AKTIF')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')->label('Kode'),
                Tables\Columns\TextColumn::make('name')->label('Nama'),
                Tables\Columns\TextColumn::make('discount_percent')->label('Diskon (%)'),
                Tables\Columns\TextColumn::make('min_total_sales')->label('Min. Penjualan'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'AKTIF',
                        'danger' => 'NONAKTIF',
                    ]),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y H:i')->label('Dibuat'),
            ])
            ->filters([])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomerTypes::route('/'),
            'create' => Pages\CreateCustomerType::route('/create'),
            'edit' => Pages\EditCustomerType::route('/{record}/edit'),
        ];
    }
}
