<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemStockLevelResource\Pages;
use App\Models\ItemStockLevel;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form as FormsForm;
use Filament\Tables\Table as TablesTable;

class ItemStockLevelResource extends Resource
{
    protected static ?string $model = ItemStockLevel::class;
    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationGroup = 'Inventory';
    protected static ?string $navigationLabel = 'Stock Levels';

    // Gunakan alias FormsForm dan TablesTable untuk kompatibilitas versi Filament
    public static function form(FormsForm $form): FormsForm
    {
        return $form->schema([
            Forms\Components\Select::make('item_id')
                ->relationship('item', 'name')
                ->required(),

            Forms\Components\Select::make('branch_id')
                ->relationship('branch', 'name')
                ->label('Branch')
                ->searchable()
                ->nullable(),

            Forms\Components\Select::make('warehouse_id')
                ->relationship('warehouse', 'name')
                ->label('Warehouse')
                ->searchable()
                ->nullable(),

            Forms\Components\TextInput::make('stock_current')
                ->numeric()
                ->label('Current Stock')
                ->required(),

            Forms\Components\TextInput::make('stock_min')
                ->numeric()
                ->label('Min Stock'),

            Forms\Components\TextInput::make('stock_max')
                ->numeric()
                ->label('Max Stock'),
        ]);
    }

    public static function table(TablesTable $table): TablesTable
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('item.name')->label('Item')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('branch.name')->label('Branch')->sortable(),
                Tables\Columns\TextColumn::make('warehouse.name')->label('Warehouse')->sortable(),
                Tables\Columns\TextColumn::make('stock_current')->label('Current'),
                Tables\Columns\TextColumn::make('stock_min')->label('Min'),
                Tables\Columns\TextColumn::make('stock_max')->label('Max'),
                Tables\Columns\TextColumn::make('updated_at')->label('Updated')->dateTime(),
            ])
            ->defaultSort('updated_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListItemStockLevels::route('/'),
            'create' => Pages\CreateItemStockLevel::route('/create'),
            'edit' => Pages\EditItemStockLevel::route('/{record}/edit'),
        ];
    }
}
