<?php

namespace App\Filament\Resources\PurchasePaymentDetailResource\Pages;

use App\Filament\Resources\PurchasePaymentDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPurchasePaymentDetail extends EditRecord
{
    protected static string $resource = PurchasePaymentDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
