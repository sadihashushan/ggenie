<?php

namespace App\Filament\Resources\GenieResource\Pages;

use App\Filament\Resources\GenieResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGenie extends EditRecord
{
    protected static string $resource = GenieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
