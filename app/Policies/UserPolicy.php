<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     * RN03: RH pode cadastrar e editar dados de colaboradores
     */
    public function viewAny(User $user): bool
    {
        // Admin e RH podem visualizar lista de colaboradores
        return in_array($user->tipo, ['admin', 'rh']);
    }

    /**
     * Determine whether the user can view the model.
     * RN03: RH pode visualizar dados de colaboradores
     */
    public function view(User $user, User $model): bool
    {
        // Admin pode ver qualquer usuário
        if ($user->tipo === 'admin') {
            return true;
        }

        // RN03: RH pode visualizar colaboradores
        if ($user->tipo === 'rh') {
            return true;
        }

        // Colaborador pode ver apenas seus próprios dados
        if ($user->tipo === 'colaborador') {
            return $user->id === $model->id;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     * RN03: RH pode cadastrar colaboradores
     */
    public function create(User $user): bool
    {
        // Admin e RH podem criar colaboradores
        return in_array($user->tipo, ['admin', 'rh']);
    }

    /**
     * Determine whether the user can update the model.
     * RN03: RH pode editar dados de colaboradores (nome, matrícula, setor, função)
     */
    public function update(User $user, User $model): bool
    {
        // Admin pode editar qualquer usuário
        if ($user->tipo === 'admin') {
            return true;
        }

        // RN03: RH pode editar colaboradores
        if ($user->tipo === 'rh') {
            return true;
        }

        // Colaborador não pode alterar informações (RN04)
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        // Apenas Admin pode deletar
        return $user->tipo === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return $user->tipo === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $user->tipo === 'admin';
    }
}
