<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChartOfAccountResource\Pages;
use App\Models\ChartOfAccount;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ChartOfAccountResource extends Resource
{
    protected static ?string $model = ChartOfAccount::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Accounting';
    protected static ?string $modelLabel = 'Chart of Account';
    protected static ?string $pluralModelLabel = 'Chart of Accounts';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->label('Kode Akun')
                    ->required()
                    ->maxLength(10),

                Forms\Components\TextInput::make('name')
                    ->label('Nama Akun')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('type')
                    ->label('Tipe Akun')
                    ->options([
                        'ASSET' => 'Aset',
                        'LIABILITY' => 'Kewajiban',
                        'EQUITY' => 'Modal',
                        'REVENUE' => 'Pendapatan',
                        'EXPENSE' => 'Beban',
                    ])
                    ->required(),

                Forms\Components\Select::make('normal_balance')
                    ->label('Saldo Normal')
                    ->options([
                        'DEBIT' => 'Debit',
                        'CREDIT' => 'Kredit',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode Akun')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Akun')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('type')
                    ->label('Tipe Akun')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'ASSET' => 'Aset',
                        'LIABILITY' => 'Kewajiban',
                        'EQUITY' => 'Modal',
                        'REVENUE' => 'Pendapatan',
                        'EXPENSE' => 'Beban',
                        default => $state,
                    })
                    ->colors([
                        'success' => 'ASSET',
                        'warning' => 'LIABILITY',
                        'info' => 'EQUITY',
                        'primary' => 'REVENUE',
                        'danger' => 'EXPENSE',
                    ]),

                Tables\Columns\TextColumn::make('normal_balance')
                    ->label('Saldo Normal')
                    ->badge()
                    ->colors([
                        'success' => 'DEBIT',
                        'danger' => 'CREDIT',
                    ]),
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
            'index' => Pages\ListChartOfAccounts::route('/'),
            'create' => Pages\CreateChartOfAccount::route('/create'),
            'edit' => Pages\EditChartOfAccount::route('/{record}/edit'),
        ];
    }
}
