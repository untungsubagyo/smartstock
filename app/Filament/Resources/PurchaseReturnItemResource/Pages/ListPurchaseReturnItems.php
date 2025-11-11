<?php

namespace App\Filament\Resources\PurchaseReturnItemResource\Pages;

use App\Filament\Resources\PurchaseReturnItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPurchaseReturnItems extends ListRecords
{
    protected static string $resource = PurchaseReturnItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
