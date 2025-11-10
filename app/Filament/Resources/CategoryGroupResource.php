<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryGroupResource\Pages;
use App\Models\CategoryGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CategoryGroupResource extends Resource
{
    protected static ?string $model = CategoryGroup::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $modelLabel = 'Kelompok Kategori';
    protected static ?string $navigationLabel = 'Kelompok Kategori';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('department_id')
                    ->relationship('department', 'name')
                    ->label('Departemen')
                    ->required(),

                Forms\Components\TextInput::make('name')
                    ->label('Nama Kelompok')
                    ->maxLength(100)
                    ->required(),

                Forms\Components\Textarea::make('description')
                    ->label('Keterangan')
                    ->rows(3),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('department.name')
                    ->label('Departemen')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Kelompok')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Keterangan')
                    ->limit(50),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('department_id')
                    ->label('Departemen')
                    ->relationship('department', 'name'),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
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
            'index' => Pages\ListCategoryGroups::route('/'),
            'create' => Pages\CreateCategoryGroup::route('/create'),
            'edit' => Pages\EditCategoryGroup::route('/{record}/edit'),
        ];
    }
}
