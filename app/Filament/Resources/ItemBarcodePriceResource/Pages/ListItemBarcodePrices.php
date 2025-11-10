<?php

namespace App\Filament\Resources\ItemBarcodePriceResource\Pages;

use App\Filament\Resources\ItemBarcodePriceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItemBarcodePrices extends ListRecords
{
    protected static string $resource = ItemBarcodePriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
