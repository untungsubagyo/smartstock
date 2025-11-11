<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockOpnameResource\Pages;
use App\Models\StockOpname;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;

class StockOpnameResource extends Resource
{
    protected static ?string $model = StockOpname::class;
    protected static ?string $navigationGroup = 'Inventory Management';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Stock Opnames';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('opname_no')
                    ->label('Nomor Opname')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(50),

                Forms\Components\Select::make('branch_id')
                    ->relationship('branch', 'name')
                    ->label('Cabang')
                    ->required(),

                Forms\Components\Select::make('warehouse_id')
                    ->relationship('warehouse', 'name')
                    ->label('Gudang'),

                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Petugas')
                    ->required(),

                Forms\Components\DatePicker::make('opname_date')
                    ->label('Tanggal Opname')
                    ->required(),

                Forms\Components\TextInput::make('total_items')
                    ->numeric()
                    ->default(0)
                    ->disabled(),

                Forms\Components\TextInput::make('total_value')
                    ->numeric()
                    ->default(0)
                    ->disabled(),

                Forms\Components\Textarea::make('note')
                    ->label('Catatan')
                    ->maxLength(65535),

                Forms\Components\Select::make('status')
                    ->options([
                        'DRAFT' => 'Draft',
                        'POSTED' => 'Posted',
                        'CANCELLED' => 'Cancelled',
                    ])
                    ->default('DRAFT')
                    ->label('Status'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('opname_no')->searchable(),
                Tables\Columns\TextColumn::make('branch.name')->label('Cabang'),
                Tables\Columns\TextColumn::make('warehouse.name')->label('Gudang'),
                Tables\Columns\TextColumn::make('user.name')->label('Petugas'),
                Tables\Columns\TextColumn::make('opname_date')->date('d M Y'),
                Tables\Columns\TextColumn::make('total_items')->label('Item'),
                Tables\Columns\TextColumn::make('total_value')->money('IDR'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'gray' => 'DRAFT',
                        'success' => 'POSTED',
                        'danger' => 'CANCELLED',
                    ]),
                Tables\Columns\TextColumn::make('created_at')->label('Dibuat')->dateTime('d M Y H:i'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()->visible(fn ($record) => $record->status === 'DRAFT'),
                Tables\Actions\DeleteAction::make()->visible(fn ($record) => $record->status === 'DRAFT'),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStockOpnames::route('/'),
            'create' => Pages\CreateStockOpname::route('/create'),
            'edit' => Pages\EditStockOpname::route('/{record}/edit'),
            // 'view' => Pages\ViewStockOpname::route('/{record}'),
        ];
    }
}
