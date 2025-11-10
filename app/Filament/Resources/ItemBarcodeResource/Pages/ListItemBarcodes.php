<?php

namespace App\Filament\Resources\ItemBarcodeResource\Pages;

use App\Filament\Resources\ItemBarcodeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItemBarcodes extends ListRecords
{
    protected static string $resource = ItemBarcodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
