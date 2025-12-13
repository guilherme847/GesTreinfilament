<?php

namespace App\Filament\Resources\TreinamentoResource\Pages;

use App\Filament\Resources\TreinamentoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTreinamentos extends ListRecords
{
    protected static string $resource = TreinamentoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
