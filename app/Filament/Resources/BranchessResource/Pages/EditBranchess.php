<?php

namespace App\Filament\Resources\BranchessResource\Pages;

use App\Filament\Resources\BranchessResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBranchess extends EditRecord
{
    protected static string $resource = BranchessResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
