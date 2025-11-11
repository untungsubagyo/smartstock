<?php

namespace App\Filament\Resources\SyncHistoryResource\Pages;

use App\Filament\Resources\SyncHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSyncHistory extends EditRecord
{
    protected static string $resource = SyncHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
