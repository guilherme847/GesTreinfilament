<?php

namespace App\Filament\Resources\TurmaResource\Pages;

use App\Filament\Resources\TurmaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTurma extends ViewRecord
{
    protected static string $resource = TurmaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
