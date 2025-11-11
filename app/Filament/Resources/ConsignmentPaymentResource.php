<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConsignmentPaymentResource\Pages;
use App\Models\ConsignmentPayment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class ConsignmentPaymentResource extends Resource
{
    protected static ?string $model = ConsignmentPayment::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Consignment Management';
    protected static ?string $modelLabel = 'Consignment Payment';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('consignment_id')
                    ->relationship('consignment', 'id')
                    ->required(),
                Forms\Components\Select::make('supplier_id')
                    ->relationship('supplier', 'name')
                    ->required(),
                Forms\Components\DatePicker::make('payment_date')
                    ->required(),
                Forms\Components\TextInput::make('total_sold')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('commission_percent')
                    ->numeric()
                    ->label('Commission (%)')
                    ->nullable(),
                Forms\Components\TextInput::make('amount_paid')
                    ->numeric()
                    ->required(),
                Forms\Components\Textarea::make('note')
                    ->maxLength(65535)
                    ->nullable(),
                Forms\Components\Select::make('status')
                    ->options([
                        'PENDING' => 'Pending',
                        'PAID' => 'Paid',
                        'CANCELLED' => 'Cancelled',
                    ])
                    ->default('PENDING')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('consignment.id')->label('Consignment ID')->sortable(),
                Tables\Columns\TextColumn::make('supplier.name')->label('Supplier')->sortable(),
                Tables\Columns\TextColumn::make('payment_date')->date(),
                Tables\Columns\TextColumn::make('total_sold')->money('idr'),
                Tables\Columns\TextColumn::make('commission_percent')->suffix('%'),
                Tables\Columns\TextColumn::make('amount_paid')->money('idr'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'PENDING',
                        'success' => 'PAID',
                        'danger' => 'CANCELLED',
                    ]),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'PENDING' => 'Pending',
                        'PAID' => 'Paid',
                        'CANCELLED' => 'Cancelled',
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
            'index' => Pages\ListConsignmentPayments::route('/'),
            'create' => Pages\CreateConsignmentPayment::route('/create'),
            'edit' => Pages\EditConsignmentPayment::route('/{record}/edit'),
        ];
    }
}
