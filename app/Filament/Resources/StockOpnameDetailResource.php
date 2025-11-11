<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockOpnameDetailResource\Pages;
use App\Models\StockOpnameDetail;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;

class StockOpnameDetailResource extends Resource
{
    protected static ?string $model = StockOpnameDetail::class;
    protected static ?string $navigationGroup = 'Inventory Management';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Stock Opname Details';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('stock_opname_id')
                    ->relationship('stockOpname', 'opname_no')
                    ->label('Nomor Opname')
                    ->required(),

                Forms\Components\Select::make('item_id')
                    ->relationship('item', 'name')
                    ->label('Barang')
                    ->required(),

                Forms\Components\Select::make('unit_id')
                    ->relationship('unit', 'name')
                    ->label('Satuan')
                    ->required(),

                Forms\Components\TextInput::make('system_stock')
                    ->numeric()
                    ->label('Stok Sistem')
                    ->required()
                    ->default(0),

                Forms\Components\TextInput::make('counted_stock')
                    ->numeric()
                    ->label('Stok Fisik')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set, callable $get) => 
                        $set('difference', $state - $get('system_stock'))
                    ),

                Forms\Components\TextInput::make('difference')
                    ->numeric()
                    ->label('Selisih (fisik - sistem)')
                    ->disabled(),

                Forms\Components\TextInput::make('hpp')
                    ->numeric()
                    ->label('HPP per Unit')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set, callable $get) => 
                        $set('value_difference', ($get('difference') ?? 0) * $state)
                    ),

                Forms\Components\TextInput::make('value_difference')
                    ->numeric()
                    ->label('Nilai Selisih')
                    ->disabled(),

                Forms\Components\Textarea::make('note')
                    ->label('Catatan')
                    ->maxLength(65535),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('stockOpname.opname_no')->label('No Opname'),
                Tables\Columns\TextColumn::make('item.name')->label('Barang')->searchable(),
                Tables\Columns\TextColumn::make('unit.name')->label('Satuan'),
                Tables\Columns\TextColumn::make('system_stock'),
                Tables\Columns\TextColumn::make('counted_stock'),
                Tables\Columns\TextColumn::make('difference')->badge()
                    ->colors([
                        'success' => fn ($state) => $state > 0,
                        'danger' => fn ($state) => $state < 0,
                        'gray' => fn ($state) => $state == 0,
                    ]),
                Tables\Columns\TextColumn::make('hpp')->money('IDR'),
                Tables\Columns\TextColumn::make('value_difference')->money('IDR'),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y H:i'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStockOpnameDetails::route('/'),
            'create' => Pages\CreateStockOpnameDetail::route('/create'),
            'edit' => Pages\EditStockOpnameDetail::route('/{record}/edit'),
            // 'view' => Pages\ViewStockOpnameDetail::route('/{record}'),
        ];
    }
}
