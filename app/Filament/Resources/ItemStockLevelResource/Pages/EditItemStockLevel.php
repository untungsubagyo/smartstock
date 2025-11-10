<?php

namespace App\Filament\Resources\ItemStockLevelResource\Pages;

use App\Filament\Resources\ItemStockLevelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditItemStockLevel extends EditRecord
{
    protected static string $resource = ItemStockLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
