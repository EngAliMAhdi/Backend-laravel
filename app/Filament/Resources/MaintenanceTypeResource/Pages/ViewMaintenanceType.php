<?php

namespace App\Filament\Resources\MaintenanceTypeResource\Pages;

use App\Filament\Resources\MaintenanceTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMaintenanceType extends ViewRecord
{
    protected static string $resource = MaintenanceTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
