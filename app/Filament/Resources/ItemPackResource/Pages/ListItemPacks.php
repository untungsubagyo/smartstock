<?php

namespace App\Filament\Resources\ItemPackResource\Pages;

use App\Filament\Resources\ItemPackResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItemPacks extends ListRecords
{
    protected static string $resource = ItemPackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
