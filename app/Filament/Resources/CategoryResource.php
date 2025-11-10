<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $modelLabel = 'Kategori';
    protected static ?string $navigationLabel = 'Kategori';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_group_id')
                    ->relationship('categoryGroup', 'name')
                    ->label('Kelompok Kategori')
                    ->required(),

                Forms\Components\TextInput::make('name')
                    ->label('Nama Kategori')
                    ->maxLength(150)
                    ->required(),

                Forms\Components\TextInput::make('min_profit')
                    ->label('Margin Minimal (%)')
                    ->numeric()
                    ->step('0.01')
                    ->default(0),

                Forms\Components\TextInput::make('max_profit')
                    ->label('Margin Maksimal (%)')
                    ->numeric()
                    ->step('0.01')
                    ->default(0),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('categoryGroup.name')
                    ->label('Kelompok Kategori')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Kategori')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('min_profit')
                    ->label('Min Margin')
                    ->numeric(2),

                Tables\Columns\TextColumn::make('max_profit')
                    ->label('Max Margin')
                    ->numeric(2),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_group_id')
                    ->label('Kelompok')
                    ->relationship('categoryGroup', 'name'),

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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
