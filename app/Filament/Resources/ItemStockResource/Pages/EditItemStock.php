<?php

namespace App\Filament\Resources\ItemStockResource\Pages;

use App\Filament\Resources\ItemStockResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditItemStock extends EditRecord
{
    protected static string $resource = ItemStockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
