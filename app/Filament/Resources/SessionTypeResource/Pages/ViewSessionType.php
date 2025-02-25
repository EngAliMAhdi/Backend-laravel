<?php

namespace App\Filament\Resources\SessionTypeResource\Pages;

use App\Filament\Resources\SessionTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSessionType extends ViewRecord
{
    protected static string $resource = SessionTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
