<?php

namespace App\Filament\Resources\NewbornUserResource\Pages;

use App\Filament\Resources\NewbornUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewNewbornUser extends ViewRecord
{
    protected static string $resource = NewbornUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
