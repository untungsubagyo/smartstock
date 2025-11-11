<?php

namespace App\Filament\Resources\StockOpnameDetailResource\Pages;

use App\Filament\Resources\StockOpnameDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStockOpnameDetails extends ListRecords
{
    protected static string $resource = StockOpnameDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
