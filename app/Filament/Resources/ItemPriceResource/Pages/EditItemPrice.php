<?php

namespace App\Filament\Resources\ItemPriceResource\Pages;

use App\Filament\Resources\ItemPriceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditItemPrice extends EditRecord
{
    protected static string $resource = ItemPriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
