<?php

namespace App\Filament\Resources\PosStationResource\Pages;

use App\Filament\Resources\PosStationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPosStations extends ListRecords
{
    protected static string $resource = PosStationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
