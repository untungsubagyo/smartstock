<?php

namespace App\Filament\Resources\CustomerReceivableResource\Pages;

use App\Filament\Resources\CustomerReceivableResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomerReceivables extends ListRecords
{
    protected static string $resource = CustomerReceivableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
