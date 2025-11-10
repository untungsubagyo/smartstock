<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemBundleResource\Pages;
use App\Models\ItemBundle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ItemBundleResource extends Resource
{
    protected static ?string $model = ItemBundle::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Barang Paket';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('parent_item_id')
                ->relationship('parentItem', 'name')
                ->label('Barang Utama (Paket)')
                ->required()
                ->searchable(),

            Forms\Components\Select::make('child_item_id')
                ->relationship('childItem', 'name')
                ->label('Barang Isi Paket')
                ->required()
                ->searchable(),

            Forms\Components\TextInput::make('qty')
                ->label('Jumlah Isi per Paket')
                ->numeric()
                ->default(1)
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('parentItem.name')
                    ->label('Barang Utama')
                    ->searchable(),

                Tables\Columns\TextColumn::make('childItem.name')
                    ->label('Barang Isi Paket')
                    ->searchable(),

                Tables\Columns\TextColumn::make('qty')
                    ->label('Qty per Paket'),
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
            'index' => Pages\ListItemBundles::route('/'),
            'create' => Pages\CreateItemBundle::route('/create'),
            'edit' => Pages\EditItemBundle::route('/{record}/edit'),
        ];
    }
}
