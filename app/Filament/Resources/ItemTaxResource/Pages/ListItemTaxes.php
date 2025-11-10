<?php

namespace App\Filament\Resources\ItemTaxResource\Pages;

use App\Filament\Resources\ItemTaxResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItemTaxes extends ListRecords
{
    protected static string $resource = ItemTaxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
