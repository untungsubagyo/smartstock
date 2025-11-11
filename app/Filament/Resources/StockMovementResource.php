<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockMovementResource\Pages;
use App\Models\StockMovement;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;

class StockMovementResource extends Resource
{
    protected static ?string $model = StockMovement::class;
    protected static ?string $navigationGroup = 'Inventory Management';
    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';
    protected static ?string $navigationLabel = 'Stock Movements';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('item_id')
                    ->relationship('item', 'name')
                    ->label('Barang')
                    ->required(),

                Forms\Components\TextInput::make('ref_no')
                    ->label('Nomor Referensi')
                    ->maxLength(50),

                Forms\Components\Select::make('ref_type')
                    ->options([
                        'PURCHASE' => 'Purchase',
                        'SALE' => 'Sale',
                        'RETURN' => 'Return',
                        'OPNAME' => 'Stock Opname',
                        'ADJUSTMENT' => 'Adjustment',
                        'TRANSFER' => 'Transfer',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('qty_in')->numeric()->default(0)->label('Qty Masuk'),
                Forms\Components\TextInput::make('qty_out')->numeric()->default(0)->label('Qty Keluar'),
                Forms\Components\TextInput::make('stock_before')->numeric()->disabled(),
                Forms\Components\TextInput::make('stock_after')->numeric()->disabled(),

                Forms\Components\Select::make('warehouse_id')
                    ->relationship('warehouse', 'name')
                    ->label('Gudang'),

                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Petugas'),

                Forms\Components\Textarea::make('note')->label('Catatan'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('item.name')->label('Barang')->searchable(),
                Tables\Columns\TextColumn::make('ref_no')->label('Ref No'),
                Tables\Columns\TextColumn::make('ref_type')->badge(),
                Tables\Columns\TextColumn::make('qty_in')->label('Masuk'),
                Tables\Columns\TextColumn::make('qty_out')->label('Keluar'),
                Tables\Columns\TextColumn::make('stock_before')->label('Stok Sebelum'),
                Tables\Columns\TextColumn::make('stock_after')->label('Stok Sesudah'),
                Tables\Columns\TextColumn::make('warehouse.name')->label('Gudang'),
                Tables\Columns\TextColumn::make('user.name')->label('Petugas'),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y H:i'),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStockMovements::route('/'),
            'create' => Pages\CreateStockMovement::route('/create'),
            // 'view' => Pages\ViewStockMovement::route('/{record}'),
        ];
    }
}
