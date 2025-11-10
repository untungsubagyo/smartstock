<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupplierResource\Pages;
use App\Models\Supplier;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;

class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Suppliers';
    protected static ?string $pluralLabel = 'Suppliers';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->label('Kode Supplier')
                    ->maxLength(20)
                    ->required(),

                Forms\Components\TextInput::make('name')
                    ->label('Nama Perusahaan')
                    ->maxLength(150)
                    ->required(),

                Forms\Components\Textarea::make('address')
                    ->label('Alamat')
                    ->rows(3),

                Forms\Components\TextInput::make('phone')
                    ->label('Telepon')
                    ->maxLength(30),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->maxLength(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')->label('Kode')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('name')->label('Nama')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('phone')->label('Telepon'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d/m/Y')->label('Dibuat'),
            ])
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
            'index' => Pages\ListSuppliers::route('/'),
            'create' => Pages\CreateSupplier::route('/create'),
            'edit' => Pages\EditSupplier::route('/{record}/edit'),
        ];
    }
}
