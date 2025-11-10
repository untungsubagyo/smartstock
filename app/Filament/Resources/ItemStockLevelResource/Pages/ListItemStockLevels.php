<?php

namespace App\Filament\Resources\ItemStockLevelResource\Pages;

use App\Filament\Resources\ItemStockLevelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItemStockLevels extends ListRecords
{
    protected static string $resource = ItemStockLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
