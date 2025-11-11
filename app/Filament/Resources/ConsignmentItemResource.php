<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConsignmentItemResource\Pages;
use App\Models\ConsignmentItem;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;

class ConsignmentItemResource extends Resource
{
    protected static ?string $model = ConsignmentItem::class;
    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationGroup = 'Manajemen Barang Titipan';
    protected static ?string $navigationLabel = 'Detail Barang Titipan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('consignment_id')
                ->relationship('consignment', 'id')
                ->required()
                ->label('Consignment'),
            Forms\Components\Select::make('item_id')
                ->relationship('item', 'name')
                ->required()
                ->label('Barang'),
            Forms\Components\Select::make('unit_id')
                ->relationship('unit', 'name')
                ->required()
                ->label('Satuan'),

            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('qty_received')->numeric()->required(),
                Forms\Components\TextInput::make('qty_sold')->numeric()->default(0),
                Forms\Components\TextInput::make('qty_returned')->numeric()->default(0),
                Forms\Components\TextInput::make('qty_remaining')->numeric()->readOnly(),
            ]),

            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('purchase_price')->numeric()->prefix('Rp'),
                Forms\Components\TextInput::make('sell_price')->numeric()->prefix('Rp'),
                Forms\Components\TextInput::make('total')->numeric()->prefix('Rp')->readOnly(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('item.name')->label('Nama Barang'),
                Tables\Columns\TextColumn::make('unit.name')->label('Satuan'),
                Tables\Columns\TextColumn::make('qty_received')->label('Diterima'),
                Tables\Columns\TextColumn::make('qty_sold')->label('Terjual'),
                Tables\Columns\TextColumn::make('qty_remaining')->label('Sisa'),
                Tables\Columns\TextColumn::make('purchase_price')->money('IDR', true)->label('Harga Beli'),
                Tables\Columns\TextColumn::make('sell_price')->money('IDR', true)->label('Harga Jual'),
                Tables\Columns\TextColumn::make('total')->money('IDR', true)->label('Total'),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y H:i'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConsignmentItems::route('/'),
            'create' => Pages\CreateConsignmentItem::route('/create'),
            'edit' => Pages\EditConsignmentItem::route('/{record}/edit'),
        ];
    }
}
