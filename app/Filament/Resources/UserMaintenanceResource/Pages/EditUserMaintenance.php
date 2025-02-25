<?php

namespace App\Filament\Resources\UserMaintenanceResource\Pages;

use App\Filament\Resources\UserMaintenanceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserMaintenance extends EditRecord
{
    protected static string $resource = UserMaintenanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
