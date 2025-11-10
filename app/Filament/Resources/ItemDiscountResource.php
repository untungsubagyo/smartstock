<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemDiscountResource\Pages;
use App\Models\ItemDiscount;
use App\Models\Item;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ItemDiscountResource extends Resource
{
    protected static ?string $model = ItemDiscount::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationGroup = 'Items Management';
    protected static ?string $navigationLabel = 'Item Discounts';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('item_id')
                    ->label('Item')
                    ->options(Item::pluck('name', 'id'))
                    ->required()
                    ->searchable(),

                Forms\Components\TextInput::make('promo_name')
                    ->label('Nama Promo')
                    ->required()
                    ->maxLength(100),

                Forms\Components\Select::make('discount_type')
                    ->label('Jenis Diskon')
                    ->options([
                        'percent' => 'Persen (%)',
                        'amount' => 'Nominal (Rp)',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('discount_value')
                    ->label('Nilai Diskon')
                    ->numeric()
                    ->prefix(fn ($get) => $get('discount_type') === 'amount' ? 'Rp' : '%')
                    ->required(),

                Forms\Components\DatePicker::make('start_date')
                    ->label('Tanggal Mulai')
                    ->required(),

                Forms\Components\DatePicker::make('end_date')
                    ->label('Tanggal Akhir'),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(3),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('item.name')->label('Item'),
                Tables\Columns\TextColumn::make('promo_name')->label('Nama Promo')->searchable(),
                Tables\Columns\TextColumn::make('discount_type')->label('Tipe Diskon'),
                Tables\Columns\TextColumn::make('discount_value')->label('Nilai Diskon')->getStateUsing(
                    fn ($record) => $record->formatted_discount
                ),
                Tables\Columns\TextColumn::make('start_date')->label('Mulai'),
                Tables\Columns\TextColumn::make('end_date')->label('Akhir'),
                Tables\Columns\IconColumn::make('is_active')->label('Aktif')->boolean(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')->label('Status Aktif'),
            ])
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
            'index' => Pages\ListItemDiscounts::route('/'),
            'create' => Pages\CreateItemDiscount::route('/create'),
            'edit' => Pages\EditItemDiscount::route('/{record}/edit'),
        ];
    }
}
