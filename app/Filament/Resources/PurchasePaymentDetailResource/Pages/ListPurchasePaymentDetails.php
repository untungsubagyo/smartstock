<?php

namespace App\Filament\Resources\PurchasePaymentDetailResource\Pages;

use App\Filament\Resources\PurchasePaymentDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPurchasePaymentDetails extends ListRecords
{
    protected static string $resource = PurchasePaymentDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
