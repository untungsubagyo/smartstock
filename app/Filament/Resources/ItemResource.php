<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemResource\Pages;
use App\Models\Item;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;
    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Items (Barang)';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Barang')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('code')->required()->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('barcode'),
                        Forms\Components\TextInput::make('name')->required(),
                        Forms\Components\TextInput::make('brand'),
                        Forms\Components\Select::make('category_id')->relationship('category', 'name'),
                        Forms\Components\Select::make('unit_id')->relationship('unit', 'name'),
                        Forms\Components\Select::make('supplier_id')->relationship('supplier', 'name'),
                        Forms\Components\TextInput::make('stock')->numeric(),
                        Forms\Components\TextInput::make('purchase_price')->numeric()->label('Harga Beli'),
                        Forms\Components\TextInput::make('sale_price')->numeric()->label('Harga Jual'),
                        Forms\Components\TextInput::make('discount_percent')->numeric()->suffix('%'),
                        Forms\Components\TextInput::make('discount_amount')->numeric()->prefix('Rp'),
                        Forms\Components\TextInput::make('margin')->numeric()->suffix('%'),
                        Forms\Components\Toggle::make('has_ppn')->label('Kena Pajak'),
                        Forms\Components\Toggle::make('ppn_include')->label('Sudah Include PPN'),
                        Forms\Components\Toggle::make('is_bulk')->label('Barang Curah'),
                        Forms\Components\TextInput::make('open_price')->numeric()->label('Harga Dapat Diubah'),
                        Forms\Components\TextInput::make('warranty_days')->numeric()->label('Garansi (hari)'),
                        Forms\Components\DatePicker::make('expired_date')->label('Tanggal Expired'),
                        Forms\Components\Toggle::make('is_active')->label('Aktif')->default(true),
                        Forms\Components\Select::make('type_hpp')
                            ->options([
                                'rata2' => 'Rata-rata',
                                'fifo' => 'FIFO',
                                'lifo' => 'LIFO',
                            ])
                            ->default('rata2')
                            ->label('Jenis HPP'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('brand'),
                Tables\Columns\TextColumn::make('stock')->label('Stok'),
                Tables\Columns\TextColumn::make('sale_price')->money('IDR', true),
                Tables\Columns\ToggleColumn::make('is_active')->label('Aktif'),
            ])
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
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }
}
