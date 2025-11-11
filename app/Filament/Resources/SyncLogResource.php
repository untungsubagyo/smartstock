<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SyncLogResource\Pages;
use App\Models\SyncLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SyncLogResource extends Resource
{
    protected static ?string $model = SyncLog::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('table_name')->required(),
                Forms\Components\TextInput::make('record_id')->numeric()->required(),
                Forms\Components\Select::make('action')
                    ->options([
                        'INSERT' => 'INSERT',
                        'UPDATE' => 'UPDATE',
                        'DELETE' => 'DELETE',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('created_by')->required(),
                Forms\Components\Toggle::make('sent_to_client')->label('Sudah dikirim?'),
                Forms\Components\DateTimePicker::make('sent_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('table_name')->searchable(),
                Tables\Columns\TextColumn::make('record_id'),
                Tables\Columns\TextColumn::make('action'),
                Tables\Columns\TextColumn::make('created_by'),
                Tables\Columns\IconColumn::make('sent_to_client')->boolean(),
                Tables\Columns\TextColumn::make('sent_at')->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime(),
            ])
            ->filters([])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSyncLogs::route('/'),
            'create' => Pages\CreateSyncLog::route('/create'),
            'edit' => Pages\EditSyncLog::route('/{record}/edit'),
        ];
    }
}
