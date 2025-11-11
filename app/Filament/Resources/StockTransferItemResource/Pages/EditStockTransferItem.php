<?php

namespace App\Filament\Resources\StockTransferItemResource\Pages;

use App\Filament\Resources\StockTransferItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStockTransferItem extends EditRecord
{
    protected static string $resource = StockTransferItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
