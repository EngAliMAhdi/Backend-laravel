<?php

namespace App\Filament\Resources\NewbornUserResource\Pages;

use App\Filament\Resources\NewbornUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNewbornUsers extends ListRecords
{
    protected static string $resource = NewbornUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
