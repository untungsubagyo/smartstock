<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemBatchResource\Pages;
use App\Models\ItemBatch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ItemBatchResource extends Resource
{
    protected static ?string $model = ItemBatch::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationGroup = 'Inventory';
    protected static ?string $modelLabel = 'Batch Barang';
    protected static ?string $navigationLabel = 'Batch Barang';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('item_id')
                    ->relationship('item', 'name')
                    ->required()
                    ->label('Item'),

                Forms\Components\TextInput::make('batch_code')
                    ->label('Kode Batch')
                    ->maxLength(100),

                Forms\Components\DatePicker::make('expired_date')
                    ->label('Tanggal Kadaluarsa'),

                Forms\Components\TextInput::make('warranty_days')
                    ->numeric()
                    ->label('Lama Garansi (hari)'),

                Forms\Components\TextInput::make('qty')
                    ->numeric()
                    ->required()
                    ->label('Jumlah Barang'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('item.name')
                    ->label('Item')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('batch_code')
                    ->label('Kode Batch')
                    ->searchable(),

                Tables\Columns\TextColumn::make('expired_date')
                    ->label('Kadaluarsa')
                    ->date(),

                Tables\Columns\TextColumn::make('warranty_days')
                    ->label('Garansi (hari)'),

                Tables\Columns\TextColumn::make('qty')
                    ->label('Jumlah')
                    ->sortable(),
            ])
            ->filters([])
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
            'index' => Pages\ListItemBatches::route('/'),
            'create' => Pages\CreateItemBatch::route('/create'),
            'edit' => Pages\EditItemBatch::route('/{record}/edit'),
        ];
    }
}
