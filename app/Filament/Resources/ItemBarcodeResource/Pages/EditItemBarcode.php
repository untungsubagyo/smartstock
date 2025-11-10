<?php

namespace App\Filament\Resources\ItemBarcodeResource\Pages;

use App\Filament\Resources\ItemBarcodeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditItemBarcode extends EditRecord
{
    protected static string $resource = ItemBarcodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
