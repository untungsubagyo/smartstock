<?php

namespace App\Filament\Resources\ConsignmentItemResource\Pages;

use App\Filament\Resources\ConsignmentItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConsignmentItems extends ListRecords
{
    protected static string $resource = ConsignmentItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
