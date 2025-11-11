<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PosStationResource\Pages;
use App\Models\PosStation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PosStationResource extends Resource
{
    protected static ?string $model = PosStation::class;

    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';
    protected static ?string $navigationGroup = 'Manajemen POS';
    protected static ?string $modelLabel = 'POS Station';
    protected static ?string $pluralModelLabel = 'POS Stations';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->label('Kode')
                    ->required()
                    ->maxLength(10),

                Forms\Components\Select::make('branch_id')
                    ->label('Cabang')
                    ->relationship('branch', 'name')
                    ->required(),

                Forms\Components\TextInput::make('ip_address')
                    ->label('IP Address')
                    ->maxLength(50),

                Forms\Components\TextInput::make('database_name')
                    ->label('Nama Database Lokal')
                    ->maxLength(50),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi'),

                Forms\Components\Select::make('connection_status')
                    ->label('Status Koneksi')
                    ->options([
                        'Terhubung' => 'Terhubung',
                        'Terputus' => 'Terputus',
                    ])
                    ->default('Terputus'),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),

                Forms\Components\DateTimePicker::make('last_sync')
                    ->label('Terakhir Sinkronisasi'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')->label('Kode'),
                Tables\Columns\TextColumn::make('branch.name')->label('Cabang'),
                Tables\Columns\TextColumn::make('ip_address')->label('IP'),
                Tables\Columns\TextColumn::make('connection_status')->label('Koneksi'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Aktif'),
                Tables\Columns\TextColumn::make('last_sync')->label('Terakhir Sinkronisasi')->dateTime(),
            ])
            ->defaultSort('code', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosStations::route('/'),
            'create' => Pages\CreatePosStation::route('/create'),
            'edit' => Pages\EditPosStation::route('/{record}/edit'),
        ];
    }
    
}
