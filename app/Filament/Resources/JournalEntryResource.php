<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JournalEntryResource\Pages;
use App\Models\JournalEntry;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\SelectFilter;

class JournalEntryResource extends Resource
{
    protected static ?string $model = JournalEntry::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';
    protected static ?string $navigationGroup = 'Akuntansi';
    protected static ?string $navigationLabel = 'Entri Jurnal';
    protected static ?string $pluralModelLabel = 'Entri Jurnal';
    protected static ?string $modelLabel = 'Entri Jurnal';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('journal_id')
                ->label('Nomor Jurnal')
                ->relationship('journal', 'journal_no')
                ->required()
                ->searchable(),

            Forms\Components\Select::make('account_id')
                ->label('Akun')
                ->relationship('account', 'name')
                ->required()
                ->searchable(),

            Forms\Components\TextInput::make('debit')
                ->label('Debit')
                ->numeric()
                ->step('0.01')
                ->default(0),

            Forms\Components\TextInput::make('credit')
                ->label('Kredit')
                ->numeric()
                ->step('0.01')
                ->default(0),

            Forms\Components\Textarea::make('note')
                ->label('Catatan')
                ->rows(2)
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('journal.journal_no')
                    ->label('No. Jurnal')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('account.name')
                    ->label('Akun')
                    ->searchable(),

                Tables\Columns\TextColumn::make('debit')
                    ->label('Debit')
                    ->numeric(2)
                    ->sortable(),

                Tables\Columns\TextColumn::make('credit')
                    ->label('Kredit')
                    ->numeric(2)
                    ->sortable(),

                Tables\Columns\TextColumn::make('note')
                    ->label('Catatan')
                    ->limit(40),
            ])
            ->filters([
                SelectFilter::make('journal_id')
                    ->label('Nomor Jurnal')
                    ->relationship('journal', 'journal_no'),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJournalEntries::route('/'),
            'create' => Pages\CreateJournalEntry::route('/create'),
            'edit' => Pages\EditJournalEntry::route('/{record}/edit'),
        ];
    }
}
