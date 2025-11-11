<?php

namespace App\Filament\Resources\PosStationResource\Pages;

use App\Filament\Resources\PosStationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPosStation extends EditRecord
{
    protected static string $resource = PosStationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
