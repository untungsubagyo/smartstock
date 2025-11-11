<?php
namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseResource\Pages;
use App\Models\Purchase;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PurchaseResource extends Resource
{
    protected static ?string $model = Purchase::class;
    protected static ?string $navigationLabel = 'Pembelian';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard';
    protected static ?string $navigationGroup = 'Pembelian';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('purchase_no')->required()->maxLength(50),
            Forms\Components\Select::make('purchase_order_id')
                ->relationship('purchaseOrder','po_number')
                ->nullable(),
            Forms\Components\Select::make('supplier_id')
                ->relationship('supplier','name')
                ->required(),
            Forms\Components\Select::make('branch_id')
                ->relationship('branch','name')
                ->required(),
            Forms\Components\Select::make('user_id')
                ->relationship('user','name')
                ->required(),
            Forms\Components\DatePicker::make('purchase_date')->required(),
            Forms\Components\DatePicker::make('due_date')->nullable(),
            Forms\Components\Select::make('payment_type')->options([
                'TUNAI'=>'TUNAI',
                'KREDIT'=>'KREDIT'
            ])->required(),
            Forms\Components\Select::make('tax_type')->options([
                'TIDAK_PPN'=>'TIDAK_PPN',
                'PPN_INCLUDE'=>'PPN_INCLUDE',
                'PPN_EXCLUDE'=>'PPN_EXCLUDE'
            ])->required(),
            Forms\Components\TextInput::make('subtotal')->numeric()->default(0),
            Forms\Components\TextInput::make('discount_percent')->numeric()->default(0),
            Forms\Components\TextInput::make('discount_amount')->numeric()->default(0),
            Forms\Components\TextInput::make('dpp')->numeric()->default(0),
            Forms\Components\TextInput::make('tax_amount')->numeric()->default(0),
            Forms\Components\TextInput::make('total_amount')->numeric()->default(0),
            Forms\Components\TextInput::make('paid_amount')->numeric()->default(0),
            Forms\Components\TextInput::make('balance')->numeric()->default(0),
            Forms\Components\Select::make('status')->options([
                'DRAFT'=>'DRAFT',
                'POSTED'=>'POSTED',
                'PAID'=>'PAID',
                'CANCELLED'=>'CANCELLED'
            ])->default('DRAFT')->required(),
            Forms\Components\Textarea::make('note')->nullable(),
            Forms\Components\Select::make('sync_status')->options([
                'PENDING'=>'PENDING',
                'SYNCED'=>'SYNCED',
                'FAILED'=>'FAILED'
            ])->default('PENDING')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('purchase_no')->searchable(),
            Tables\Columns\TextColumn::make('purchaseOrder.po_number')->label('PO')->sortable(),
            Tables\Columns\TextColumn::make('supplier.name')->label('Supplier')->sortable(),
            Tables\Columns\TextColumn::make('branch.name')->label('Cabang')->sortable(),
            Tables\Columns\TextColumn::make('user.name')->label('Operator')->sortable(),
            Tables\Columns\TextColumn::make('purchase_date')->date()->sortable(),
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
            'index' => Pages\ListPurchases::route('/'),
            'create' => Pages\CreatePurchase::route('/create'),
            'edit' => Pages\EditPurchase::route('/{record}/edit'),
        ];
    }
}
