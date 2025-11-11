<?php
namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseOrderResource\Pages;
use App\Models\PurchaseOrder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\table;

class PurchaseOrderResource extends Resource
{
    protected static ?string $model = PurchaseOrder::class;
    protected static ?string $navigationLabel = 'Purchase Orders';
    protected static ?string $navigationIcon = 'heroicon-o-document-text'; // icon aman
    protected static ?string $navigationGroup = 'Pembelian';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('po_number')->required()->maxLength(50),
            Forms\Components\Select::make('supplier_id')->relationship('supplier','name')->required(),
            Forms\Components\Select::make('branch_id')->relationship('branch','name')->required(),
            Forms\Components\Select::make('user_id')->relationship('user','name')->required(),
            Forms\Components\DatePicker::make('order_date')->required(),
            Forms\Components\DatePicker::make('delivery_date')->nullable(),
            Forms\Components\Select::make('payment_type')->options([
                'TUNAI'=>'TUNAI',
                'KREDIT'=>'KREDIT'
            ])->required(),
            Forms\Components\Select::make('tax_type')->options([
                'TIDAK_PPN'=>'TIDAK_PPN',
                'PPN_INCLUDE'=>'PPN_INCLUDE',
                'PPN_EXCLUDE'=>'PPN_EXCLUDE'
            ])->required(),
            Forms\Components\Textarea::make('note')->nullable(),
            Forms\Components\TextInput::make('subtotal')->numeric()->default(0),
            Forms\Components\TextInput::make('discount_percent')->numeric()->default(0),
            Forms\Components\TextInput::make('discount_amount')->numeric()->default(0),
            Forms\Components\TextInput::make('dpp')->numeric()->default(0),
            Forms\Components\TextInput::make('tax_amount')->numeric()->default(0),
            Forms\Components\TextInput::make('total_amount')->numeric()->default(0),
            Forms\Components\Select::make('status')->options([
                'DRAFT'=>'DRAFT',
                'APPROVED'=>'APPROVED',
                'RECEIVED'=>'RECEIVED',
                'CANCELLED'=>'CANCELLED'
            ])->default('DRAFT')->required(),
            Forms\Components\Select::make('sync_status')->options([
                'PENDING'=>'PENDING',
                'SYNCED'=>'SYNCED',
                'FAILED'=>'FAILED'
            ])->default('PENDING')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('po_number')->searchable(),
                Tables\Columns\TextColumn::make('supplier.name')->label('Supplier')->sortable(),
                Tables\Columns\TextColumn::make('branch.name')->label('Cabang')->sortable(),
                Tables\Columns\TextColumn::make('user.name')->label('Dibuat Oleh')->sortable(),
                Tables\Columns\TextColumn::make('order_date')->date()->sortable(),
                Tables\Columns\TextColumn::make('total_amount')->money('idr', true)->sortable(),
                Tables\Columns\TextColumn::make('status')->sortable(),
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
            'index' => Pages\ListPurchaseOrders::route('/'),
            'create' => Pages\CreatePurchaseOrder::route('/create'),
            'edit' => Pages\EditPurchaseOrder::route('/{record}/edit'),
        ];
    }
}
