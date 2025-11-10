<?php

namespace App\Filament\Resources\ItemExtraCostResource\Pages;

use App\Filament\Resources\ItemExtraCostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItemExtraCosts extends ListRecords
{
    protected static string $resource = ItemExtraCostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
