<?php

namespace App\Filament\Resources\ItemVariantResource\Pages;

use App\Filament\Resources\ItemVariantResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItemVariants extends ListRecords
{
    protected static string $resource = ItemVariantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
