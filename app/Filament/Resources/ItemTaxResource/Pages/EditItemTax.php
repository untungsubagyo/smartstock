<?php

namespace App\Filament\Resources\ItemTaxResource\Pages;

use App\Filament\Resources\ItemTaxResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditItemTax extends EditRecord
{
    protected static string $resource = ItemTaxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
