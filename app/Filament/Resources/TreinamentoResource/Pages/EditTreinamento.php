<?php

namespace App\Filament\Resources\TreinamentoResource\Pages;

use App\Filament\Resources\TreinamentoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Validation\ValidationException;

class EditTreinamento extends EditRecord
{
    protected static string $resource = TreinamentoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $user = auth()->user();
        $treinamento = $this->record;
        
        // RN01: Apenas Técnico de Segurança e Admin podem alterar treinamentos para obrigatórios
        if (isset($data['Tipo']) && $data['Tipo'] === 'obrigatorio') {
            if (!in_array($user->tipo, ['admin', 'tecnico_seguranca'])) {
                // Se já era obrigatório, RH pode manter, mas não pode alterar de não-obrigatório para obrigatório
                if ($treinamento->Tipo !== 'obrigatorio') {
                    throw ValidationException::withMessages([
                        'Tipo' => 'RN01: Apenas o Técnico de Segurança pode alterar treinamentos para obrigatórios.',
                    ]);
                }
            }
        }
        
        // RN03: RH não pode alterar treinamento não-obrigatório para obrigatório
        if ($user->tipo === 'rh' && isset($data['Tipo'])) {
            if ($treinamento->Tipo !== 'obrigatorio' && $data['Tipo'] === 'obrigatorio') {
                throw ValidationException::withMessages([
                    'Tipo' => 'RN03: O setor de RH não pode alterar treinamentos para obrigatórios.',
                ]);
            }
        }

        return $data;
    }
}
