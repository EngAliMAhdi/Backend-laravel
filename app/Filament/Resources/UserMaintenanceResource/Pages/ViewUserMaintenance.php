<?php

namespace App\Filament\Resources\UserMaintenanceResource\Pages;

use App\Filament\Resources\UserMaintenanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUserMaintenance extends ViewRecord
{
    protected static string $resource = UserMaintenanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
