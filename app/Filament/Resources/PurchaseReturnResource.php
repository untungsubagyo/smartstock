<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseReturnResource\Pages;
use App\Models\PurchaseReturn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PurchaseReturnResource extends Resource
{
    protected static ?string $model = PurchaseReturn::class;
    protected static ?string $navigationIcon = 'heroicon-o-arrow-uturn-left';
    protected static ?string $navigationGroup = 'Pembelian';
    protected static ?string $navigationLabel = 'Purchase Returns';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('return_no')
                ->label('Nomor Retur')
                ->required()
                ->unique(ignoreRecord: true),

            Forms\Components\Select::make('purchase_id')
                ->relationship('purchase', 'id')
                ->label('Purchase (Opsional)')
                ->searchable(),

            Forms\Components\Select::make('supplier_id')
                ->relationship('supplier', 'name')
                ->label('Supplier')
                ->required(),

            Forms\Components\Select::make('branch_id')
                ->relationship('branch', 'name')
                ->label('Cabang')
                ->required(),

            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->label('User Retur')
                ->required(),

            Forms\Components\DatePicker::make('return_date')
                ->label('Tanggal Retur')
                ->required(),

            Forms\Components\TextInput::make('subtotal')->numeric()->label('Subtotal'),
            Forms\Components\TextInput::make('discount_percent')->numeric()->label('Diskon (%)'),
            Forms\Components\TextInput::make('discount_amount')->numeric()->label('Diskon Nominal'),
            Forms\Components\TextInput::make('tax_amount')->numeric()->label('PPN'),
            Forms\Components\TextInput::make('total_amount')->numeric()->label('Total Akhir'),

            Forms\Components\Textarea::make('note')->label('Catatan'),

            Forms\Components\Select::make('status')
                ->options([
                    'DRAFT' => 'Draft',
                    'POSTED' => 'Posted',
                    'CANCELLED' => 'Cancelled',
                ])
                ->default('DRAFT'),

            Forms\Components\Select::make('sync_status')
                ->options([
                    'PENDING' => 'Pending',
                    'SYNCED' => 'Synced',
                    'FAILED' => 'Failed',
                ])
                ->default('PENDING'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('return_no')->label('No Retur')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('supplier.name')->label('Supplier'),
                Tables\Columns\TextColumn::make('branch.name')->label('Cabang'),
                Tables\Columns\TextColumn::make('return_date')->date('d M Y')->label('Tanggal'),
                Tables\Columns\TextColumn::make('total_amount')->money('IDR')->label('Total'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'primary' => 'DRAFT',
                        'success' => 'POSTED',
                        'danger' => 'CANCELLED',
                    ]),
                Tables\Columns\BadgeColumn::make('sync_status')
                    ->colors([
                        'warning' => 'PENDING',
                        'success' => 'SYNCED',
                        'danger' => 'FAILED',
                    ]),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y H:i')->label('Dibuat'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPurchaseReturns::route('/'),
            'create' => Pages\CreatePurchaseReturn::route('/create'),
            'edit' => Pages\EditPurchaseReturn::route('/{record}/edit'),
        ];
    }
}
