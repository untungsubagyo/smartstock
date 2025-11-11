<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockTransferResource\Pages;
use App\Models\StockTransfer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Support\Str;

class StockTransferResource extends Resource
{
    protected static ?string $model = StockTransfer::class;
    protected static ?string $navigationIcon = 'heroicon-o-arrow-path';
    protected static ?string $navigationGroup = 'Inventory';
    protected static ?string $modelLabel = 'Stock Transfer';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('transfer_no')
                    ->label('Transfer No')
                    ->default(fn() => 'MT-' . str_pad(StockTransfer::max('id') + 1, 5, '0', STR_PAD_LEFT))
                    ->disabled()
                    ->dehydrated(),
                Forms\Components\Select::make('from_branch_id')
                    ->relationship('fromBranch', 'name')
                    ->required()
                    ->label('From Branch'),
                Forms\Components\Select::make('to_branch_id')
                    ->relationship('toBranch', 'name')
                    ->required()
                    ->label('To Branch'),
                Forms\Components\Select::make('transfer_type')
                    ->options(['IN' => 'IN', 'OUT' => 'OUT'])
                    ->required(),
                Forms\Components\DatePicker::make('transfer_date')
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\TextInput::make('total_qty')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('total_value')
                    ->numeric()
                    ->required(),
                Forms\Components\Textarea::make('note')->nullable(),
                Forms\Components\Select::make('status')
                    ->options([
                        'DRAFT' => 'Draft',
                        'POSTED' => 'Posted',
                        'CANCELLED' => 'Cancelled',
                    ])
                    ->default('DRAFT')
                    ->required(),
                Forms\Components\Select::make('sync_status')
                    ->options([
                        'PENDING' => 'Pending',
                        'SYNCED' => 'Synced',
                        'FAILED' => 'Failed',
                    ])
                    ->default('PENDING')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transfer_no')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('fromBranch.name')->label('From'),
                Tables\Columns\TextColumn::make('toBranch.name')->label('To'),
                Tables\Columns\TextColumn::make('transfer_type'),
                Tables\Columns\TextColumn::make('transfer_date')->date(),
                Tables\Columns\TextColumn::make('user.name')->label('User'),
                Tables\Columns\TextColumn::make('total_qty')->numeric(2),
                Tables\Columns\TextColumn::make('total_value')->money('idr'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'gray' => 'DRAFT',
                        'success' => 'POSTED',
                        'danger' => 'CANCELLED',
                    ]),
                Tables\Columns\BadgeColumn::make('sync_status')
                    ->colors([
                        'warning' => 'PENDING',
                        'success' => 'SYNCED',
                        'danger' => 'FAILED',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options([
                    'DRAFT' => 'Draft',
                    'POSTED' => 'Posted',
                    'CANCELLED' => 'Cancelled',
                ]),
                Tables\Filters\SelectFilter::make('sync_status')->options([
                    'PENDING' => 'Pending',
                    'SYNCED' => 'Synced',
                    'FAILED' => 'Failed',
                ]),
            ])
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
            'index' => Pages\ListStockTransfers::route('/'),
            'create' => Pages\CreateStockTransfer::route('/create'),
            'edit' => Pages\EditStockTransfer::route('/{record}/edit'),
        ];
    }
}
