<?php

namespace App\Filament\Resources\PurchaseReturnItemResource\Pages;

use App\Filament\Resources\PurchaseReturnItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPurchaseReturnItem extends EditRecord
{
    protected static string $resource = PurchaseReturnItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
