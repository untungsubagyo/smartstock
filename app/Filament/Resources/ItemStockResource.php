<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemStockResource\Pages;
use App\Models\ItemStock;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ItemStockResource extends Resource
{
    protected static ?string $model = ItemStock::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationGroup = 'Inventory Management';
    protected static ?string $navigationLabel = 'Item Stocks';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('item_id')
                    ->relationship('item', 'name')
                    ->required()
                    ->searchable(),

                Forms\Components\Select::make('warehouse_id')
                    ->relationship('warehouse', 'name')
                    ->required()
                    ->searchable(),

                Forms\Components\TextInput::make('stock_in')
                    ->numeric()
                    ->default(0),

                Forms\Components\TextInput::make('stock_out')
                    ->numeric()
                    ->default(0),

                Forms\Components\TextInput::make('stock_balance')
                    ->numeric()
                    ->default(0),

                Forms\Components\DateTimePicker::make('last_update')
                    ->default(now())
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('item.name')->label('Item'),
                Tables\Columns\TextColumn::make('warehouse.name')->label('Warehouse'),
                Tables\Columns\TextColumn::make('stock_in')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('stock_out')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('stock_balance')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('last_update')->dateTime()->sortable(),
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

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListItemStocks::route('/'),
            'create' => Pages\CreateItemStock::route('/create'),
            'edit' => Pages\EditItemStock::route('/{record}/edit'),
        ];
    }
}
