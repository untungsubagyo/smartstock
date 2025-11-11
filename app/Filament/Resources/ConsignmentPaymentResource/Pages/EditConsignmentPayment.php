<?php

namespace App\Filament\Resources\ConsignmentPaymentResource\Pages;

use App\Filament\Resources\ConsignmentPaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConsignmentPayment extends EditRecord
{
    protected static string $resource = ConsignmentPaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
