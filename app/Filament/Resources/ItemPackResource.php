<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemPackResource\Pages;
use App\Models\ItemPack;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;

class ItemPackResource extends Resource
{
    protected static ?string $model = ItemPack::class;
    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationGroup = 'Inventory';
    protected static ?string $navigationLabel = 'Item Packs';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('item_id')
                ->relationship('item', 'name')
                ->label('Item')
                ->required(),

            Forms\Components\Select::make('unit_id')
                ->relationship('unit', 'name')
                ->label('Unit')
                ->required(),

            Forms\Components\TextInput::make('pack_name')
                ->label('Pack Name')
                ->maxLength(100)
                ->required(),

            Forms\Components\TextInput::make('qty_per_pack')
                ->numeric()
                ->label('Qty per Pack')
                ->required(),

            Forms\Components\TextInput::make('hpp_per_pack')
                ->numeric()
                ->label('HPP per Pack')
                ->required(),

            Forms\Components\TextInput::make('margin')
                ->numeric()
                ->label('Margin (%)')
                ->required(),

            Forms\Components\TextInput::make('sale_price')
                ->numeric()
                ->label('Sale Price')
                ->required(),

            Forms\Components\Toggle::make('is_default')
                ->label('Default')
                ->inline(false),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('item.name')->label('Item')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('unit.name')->label('Unit'),
            Tables\Columns\TextColumn::make('pack_name')->label('Pack'),
            Tables\Columns\TextColumn::make('qty_per_pack')->label('Qty/Pack'),
            Tables\Columns\TextColumn::make('hpp_per_pack')->label('HPP/Pack'),
            Tables\Columns\TextColumn::make('margin')->label('Margin (%)'),
            Tables\Columns\TextColumn::make('sale_price')->label('Sale Price'),
            Tables\Columns\IconColumn::make('is_default')
                ->boolean()
                ->label('Default'),
            Tables\Columns\TextColumn::make('updated_at')->dateTime()->label('Updated'),
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
            'index' => Pages\ListItemPacks::route('/'),
            'create' => Pages\CreateItemPack::route('/create'),
            'edit' => Pages\EditItemPack::route('/{record}/edit'),
        ];
    }
}
