<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemTaxResource\Pages;
use App\Models\ItemTax;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;

class ItemTaxResource extends Resource
{
    protected static ?string $model = ItemTax::class;
    protected static ?string $navigationIcon = 'heroicon-o-receipt-percent';
    protected static ?string $navigationGroup = 'Inventory';
    protected static ?string $navigationLabel = 'Item Taxes';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('item_id')
                ->relationship('item', 'name')
                ->label('Item')
                ->required(),

            Forms\Components\TextInput::make('tax_type')
                ->label('Tax Type')
                ->placeholder('Contoh: PPN, PPnBM, dll')
                ->maxLength(50)
                ->required(),

            Forms\Components\TextInput::make('rate')
                ->numeric()
                ->label('Rate (%)')
                ->default(0)
                ->required(),

            Forms\Components\Toggle::make('included')
                ->label('Included in Price')
                ->helperText('Apakah pajak sudah termasuk harga jual?'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('item.name')
                ->label('Item')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('tax_type')
                ->label('Tax Type')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('rate')
                ->label('Rate (%)')
                ->sortable(),

            Tables\Columns\IconColumn::make('included')
                ->boolean()
                ->label('Included'),

            Tables\Columns\TextColumn::make('updated_at')
                ->label('Updated At')
                ->dateTime(),
        ])
        ->defaultSort('item_id')
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
            'index' => Pages\ListItemTaxes::route('/'),
            'create' => Pages\CreateItemTax::route('/create'),
            'edit' => Pages\EditItemTax::route('/{record}/edit'),
        ];
    }
}
