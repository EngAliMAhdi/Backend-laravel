<?php

namespace App\Filament\Resources\UserMaintenanceResource\Pages;

use App\Filament\Resources\UserMaintenanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserMaintenances extends ListRecords
{
    protected static string $resource = UserMaintenanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
