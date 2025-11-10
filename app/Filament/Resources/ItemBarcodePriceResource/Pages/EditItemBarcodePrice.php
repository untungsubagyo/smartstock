<?php

namespace App\Filament\Resources\ItemBarcodePriceResource\Pages;

use App\Filament\Resources\ItemBarcodePriceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditItemBarcodePrice extends EditRecord
{
    protected static string $resource = ItemBarcodePriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
