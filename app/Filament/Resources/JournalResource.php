<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JournalResource\Pages;
use App\Models\Journal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\SelectFilter;

class JournalResource extends Resource
{
    protected static ?string $model = Journal::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Akuntansi';
    protected static ?string $navigationLabel = 'Jurnal Umum';
    protected static ?string $pluralModelLabel = 'Jurnal';
    protected static ?string $modelLabel = 'Jurnal';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('journal_no')
                ->label('Nomor Jurnal')
                ->required()
                ->maxLength(50)
                ->unique(ignoreRecord: true),

            Forms\Components\DatePicker::make('journal_date')
                ->label('Tanggal Jurnal')
                ->required(),

            Forms\Components\Select::make('source_module')
                ->label('Sumber Modul')
                ->options([
                    'SALES' => 'Penjualan',
                    'PURCHASE' => 'Pembelian',
                    'CASH' => 'Kas/Bank',
                    'STOCK' => 'Persediaan',
                    'OTHER' => 'Lainnya',
                ])
                ->nullable(),

            Forms\Components\TextInput::make('source_id')
                ->label('ID Sumber')
                ->numeric()
                ->nullable(),

            Forms\Components\Textarea::make('description')
                ->label('Deskripsi')
                ->rows(3)
                ->columnSpanFull(),

            Forms\Components\TextInput::make('total_debit')
                ->label('Total Debit')
                ->numeric()
                ->step('0.01')
                ->default(0),

            Forms\Components\TextInput::make('total_credit')
                ->label('Total Kredit')
                ->numeric()
                ->step('0.01')
                ->default(0),

            Forms\Components\Select::make('status')
                ->label('Status')
                ->options([
                    'POSTED' => 'Posted',
                    'VOID' => 'Void',
                ])
                ->default('POSTED')
                ->required(),
        ]);
    }

   public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('journal_no')
                ->label('No. Jurnal')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('journal_date')
                ->label('Tanggal')
                ->date()
                ->sortable(),

            Tables\Columns\TextColumn::make('source_module')
                ->label('Sumber Modul'),

            Tables\Columns\TextColumn::make('description')
                ->label('Deskripsi')
                ->limit(40),

            Tables\Columns\TextColumn::make('total_debit')
                ->label('Debit')
                ->numeric(2),

            Tables\Columns\TextColumn::make('total_credit')
                ->label('Kredit')
                ->numeric(2),

            Tables\Columns\BadgeColumn::make('status')
                ->label('Status')
                ->formatStateUsing(fn (string $state): string => match ($state) {
                    'POSTED' => 'Posted',
                    'VOID' => 'Void',
                    default => ucfirst(strtolower($state)),
                })
                ->colors(fn (string $state): string => match ($state) {
                    'POSTED' => 'success',
                    'VOID' => 'danger',
                    default => 'secondary',
                }),
        ])
        ->filters([
            SelectFilter::make('status')
                ->options([
                    'POSTED' => 'Posted',
                    'VOID' => 'Void',
                ]),
        ])
        ->defaultSort('journal_date', 'desc');
}


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJournals::route('/'),
            'create' => Pages\CreateJournal::route('/create'),
            'edit' => Pages\EditJournal::route('/{record}/edit'),
        ];
    }
}
