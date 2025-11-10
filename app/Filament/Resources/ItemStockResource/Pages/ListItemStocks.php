<?php

namespace App\Filament\Resources\ItemStockResource\Pages;

use App\Filament\Resources\ItemStockResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItemStocks extends ListRecords
{
    protected static string $resource = ItemStockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
