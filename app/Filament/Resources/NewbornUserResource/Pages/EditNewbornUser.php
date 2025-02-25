<?php

namespace App\Filament\Resources\NewbornUserResource\Pages;

use App\Filament\Resources\NewbornUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNewbornUser extends EditRecord
{
    protected static string $resource = NewbornUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
