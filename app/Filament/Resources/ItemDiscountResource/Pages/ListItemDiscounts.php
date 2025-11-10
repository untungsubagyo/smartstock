<?php

namespace App\Filament\Resources\ItemDiscountResource\Pages;

use App\Filament\Resources\ItemDiscountResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItemDiscounts extends ListRecords
{
    protected static string $resource = ItemDiscountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
