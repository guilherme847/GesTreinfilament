<?php

namespace App\Filament\Resources\TreinamentoResource\Pages;

use App\Filament\Resources\TreinamentoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Illuminate\Validation\ValidationException;

class CreateTreinamento extends CreateRecord
{
    protected static string $resource = TreinamentoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = auth()->user();
        
        // RN01: Apenas Técnico de Segurança e Admin podem cadastrar treinamentos obrigatórios
        if (isset($data['Tipo']) && $data['Tipo'] === 'obrigatorio') {
            if (!in_array($user->tipo, ['admin', 'tecnico_seguranca'])) {
                throw ValidationException::withMessages([
                    'Tipo' => 'RN01: Apenas o Técnico de Segurança pode cadastrar treinamentos obrigatórios relacionados à segurança do trabalho.',
                ]);
            }
        }
        
        // RN03: RH pode criar apenas treinamentos não-obrigatórios
        if ($user->tipo === 'rh' && isset($data['Tipo']) && $data['Tipo'] === 'obrigatorio') {
            throw ValidationException::withMessages([
                'Tipo' => 'RN03: O setor de RH pode criar apenas treinamentos voltados para área de RH (opcional, reciclagem ou inicial).',
            ]);
        }

        return $data;
    }
}
