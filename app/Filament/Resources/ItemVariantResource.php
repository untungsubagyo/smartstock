<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemVariantResource\Pages;
use App\Models\ItemVariant;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;

class ItemVariantResource extends Resource
{
    protected static ?string $model = ItemVariant::class;
    protected static ?string $navigationIcon = 'heroicon-o-view-columns';
    protected static ?string $navigationGroup = 'Inventory';
    protected static ?string $navigationLabel = 'Item Variants';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('item_id')
                ->relationship('item', 'name')
                ->label('Item')
                ->required(),

            Forms\Components\TextInput::make('color')
                ->maxLength(50)
                ->label('Color')
                ->placeholder('Contoh: Merah, Biru, dll'),

            Forms\Components\TextInput::make('size')
                ->maxLength(50)
                ->label('Size')
                ->placeholder('Contoh: M, L, XL'),

            Forms\Components\TextInput::make('type')
                ->maxLength(50)
                ->label('Type / Bahan')
                ->placeholder('Contoh: Katun, Denim, Rasa Coklat'),

            Forms\Components\TextInput::make('sku')
                ->maxLength(50)
                ->unique(ignoreRecord: true)
                ->label('SKU')
                ->required(),

            Forms\Components\TextInput::make('stock')
                ->numeric()
                ->label('Stock')
                ->default(0)
                ->required(),

            Forms\Components\TextInput::make('price')
                ->numeric()
                ->label('Price (Optional)')
                ->placeholder('Kosongkan untuk harga default'),

            Forms\Components\TextInput::make('barcode')
                ->maxLength(100)
                ->label('Barcode')
                ->placeholder('Contoh: 899888776655'),

            Forms\Components\Toggle::make('is_active')
                ->label('Active')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('item.name')
                ->label('Item')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('sku')
                ->label('SKU')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('color')->label('Color'),
            Tables\Columns\TextColumn::make('size')->label('Size'),
            Tables\Columns\TextColumn::make('type')->label('Type'),

            Tables\Columns\TextColumn::make('stock')
                ->numeric()
                ->label('Stock'),

            Tables\Columns\TextColumn::make('price')
                ->numeric()
                ->label('Price')
                ->money('IDR', true),

            Tables\Columns\IconColumn::make('is_active')
                ->boolean()
                ->label('Active'),

            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->label('Updated At'),
        ])
        ->defaultSort('item_id')
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
            'index' => Pages\ListItemVariants::route('/'),
            'create' => Pages\CreateItemVariant::route('/create'),
            'edit' => Pages\EditItemVariant::route('/{record}/edit'),
        ];
    }
}
