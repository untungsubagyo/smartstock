<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConsignmentResource\Pages;
use App\Models\Consignment;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;

class ConsignmentResource extends Resource
{
    protected static ?string $model = Consignment::class;
    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationGroup = 'Pembelian';
    protected static ?string $navigationLabel = 'Konsinyasi Masuk';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('consignment_no')
                ->label('Nomor Konsinyasi')
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(50),

            Forms\Components\DatePicker::make('consignment_date')
                ->label('Tanggal Konsinyasi')
                ->required(),

            Forms\Components\DatePicker::make('due_date')
                ->label('Jatuh Tempo'),

            Forms\Components\Select::make('supplier_id')
                ->relationship('supplier', 'name')
                ->required()
                ->label('Supplier'),

            Forms\Components\Select::make('branch_id')
                ->relationship('branch', 'name')
                ->required()
                ->label('Cabang'),

            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->required()
                ->label('User'),

            Forms\Components\TextInput::make('subtotal')->numeric()->default(0)->label('Subtotal'),
            Forms\Components\TextInput::make('discount_percent')->numeric()->default(0)->label('Diskon (%)'),
            Forms\Components\TextInput::make('discount_amount')->numeric()->default(0)->label('Diskon Nominal'),
            Forms\Components\TextInput::make('tax_amount')->numeric()->default(0)->label('PPN'),
            Forms\Components\TextInput::make('total_amount')->numeric()->default(0)->label('Total'),

            Forms\Components\Textarea::make('note')->label('Catatan'),
            Forms\Components\Select::make('status')
                ->options([
                    'DRAFT' => 'Draft',
                    'POSTED' => 'Posted',
                    'RETURNED' => 'Returned',
                    'CLOSED' => 'Closed',
                ])
                ->default('DRAFT')
                ->label('Status'),

            Forms\Components\Select::make('sync_status')
                ->options([
                    'PENDING' => 'Pending',
                    'SYNCED' => 'Synced',
                    'FAILED' => 'Failed',
                ])
                ->default('PENDING')
                ->label('Sinkronisasi'),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('consignment_no')->label('Nomor'),
                Tables\Columns\TextColumn::make('supplier.name')->label('Supplier'),
                Tables\Columns\TextColumn::make('branch.name')->label('Cabang'),
                Tables\Columns\TextColumn::make('consignment_date')->date(),
                Tables\Columns\TextColumn::make('total_amount')->money('IDR'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'gray' => 'DRAFT',
                        'warning' => 'POSTED',
                        'danger' => 'RETURNED',
                        'success' => 'CLOSED',
                    ]),
                Tables\Columns\BadgeColumn::make('sync_status')
                    ->colors([
                        'warning' => 'PENDING',
                        'success' => 'SYNCED',
                        'danger' => 'FAILED',
                    ]),
            ])
            ->filters([])
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
            'index' => Pages\ListConsignments::route('/'),
            'create' => Pages\CreateConsignment::route('/create'),
            'edit' => Pages\EditConsignment::route('/{record}/edit'),
        ];
    }
}
