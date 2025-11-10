<?php

namespace App\Filament\Resources\ItemVariantResource\Pages;

use App\Filament\Resources\ItemVariantResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditItemVariant extends EditRecord
{
    protected static string $resource = ItemVariantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
