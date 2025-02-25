<?php

namespace App\Filament\Resources\PlacementResource\Pages;

use App\Filament\Resources\PlacementResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPlacement extends ViewRecord
{
    protected static string $resource = PlacementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
