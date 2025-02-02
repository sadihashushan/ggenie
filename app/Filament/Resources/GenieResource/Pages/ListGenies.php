<?php

namespace App\Filament\Resources\GenieResource\Pages;

use App\Filament\Resources\GenieResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGenies extends ListRecords
{
    protected static string $resource = GenieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
