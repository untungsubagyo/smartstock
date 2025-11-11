<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SyncHistoryResource\Pages;
use App\Models\SyncHistory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SyncHistoryResource extends Resource
{
    protected static ?string $model = SyncHistory::class;
    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationGroup = 'Sinkronisasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('pos_station_id')
                    ->relationship('posStation', 'code')
                    ->label('POS Station')
                    ->required(),
                Forms\Components\Select::make('direction')
                    ->options([
                        'PUSH' => 'PUSH (Kasir → Server)',
                        'PULL' => 'PULL (Server → Kasir)',
                    ])
                    ->required(),
                Forms\Components\DateTimePicker::make('started_at'),
                Forms\Components\DateTimePicker::make('finished_at'),
                Forms\Components\TextInput::make('total_records')->numeric(),
                Forms\Components\TextInput::make('success_count')->numeric(),
                Forms\Components\TextInput::make('failed_count')->numeric(),
                Forms\Components\Select::make('status')
                    ->options([
                        'SUCCESS' => 'SUCCESS',
                        'PARTIAL' => 'PARTIAL',
                        'FAILED' => 'FAILED',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('message')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('posStation.code')->label('POS Station')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('direction'),
                Tables\Columns\TextColumn::make('total_records'),
                Tables\Columns\TextColumn::make('success_count'),
                Tables\Columns\TextColumn::make('failed_count'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'SUCCESS',
                        'warning' => 'PARTIAL',
                        'danger' => 'FAILED',
                    ]),
                Tables\Columns\TextColumn::make('started_at')->dateTime(),
                Tables\Columns\TextColumn::make('finished_at')->dateTime(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSyncHistories::route('/'),
            'create' => Pages\CreateSyncHistory::route('/create'),
            'edit' => Pages\EditSyncHistory::route('/{record}/edit'),
        ];
    }
}
