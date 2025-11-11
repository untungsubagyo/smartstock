<?php

namespace App\Filament\Resources\CustomerReceivableResource\Pages;

use App\Filament\Resources\CustomerReceivableResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomerReceivable extends EditRecord
{
    protected static string $resource = CustomerReceivableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
