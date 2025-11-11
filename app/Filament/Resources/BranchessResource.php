<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BranchessResource\Pages;
use App\Models\Branch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BranchesResource extends Resource
{
    protected static ?string $model = Branch::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Cabang (Branches)';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->label('Kode Cabang')
                    ->required()
                    ->maxLength(10),

                Forms\Components\TextInput::make('name')
                    ->label('Nama Cabang')
                    ->required()
                    ->maxLength(100),

                Forms\Components\Textarea::make('address')
                    ->label('Alamat')
                    ->required(),

                Forms\Components\TextInput::make('city')
                    ->label('Kota')
                    ->required(),

                Forms\Components\TextInput::make('province')
                    ->label('Provinsi'),

                Forms\Components\TextInput::make('phone')
                    ->label('Nomor Telepon'),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email(),

                Forms\Components\FileUpload::make('logo_path')
                    ->label('Logo Cabang')
                    ->directory('branches/logos')
                    ->image(),

                Forms\Components\Toggle::make('is_main')
                    ->label('Cabang Utama'),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('city')
                    ->label('Kota'),

                Tables\Columns\IconColumn::make('is_main')
                    ->label('Utama')
                    ->boolean(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
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
            'index' => Pages\ListBranchesses::route('/'),
            'create' => Pages\CreateBranchess::route('/create'),
            'edit' => Pages\EditBranchess::route('/{record}/edit'),
        ];
    }
}
