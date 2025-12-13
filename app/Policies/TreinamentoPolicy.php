<?php

namespace App\Policies;

use App\Models\Treinamento;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TreinamentoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Admin, Técnico de Segurança, RH e Instrutor podem visualizar
        return in_array($user->tipo, ['admin', 'tecnico_seguranca', 'rh', 'instrutor']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Treinamento $treinamento): bool
    {
        // Admin, Técnico de Segurança, RH e Instrutor podem visualizar
        return in_array($user->tipo, ['admin', 'tecnico_seguranca', 'rh', 'instrutor']);
    }

    /**
     * Determine whether the user can create models.
     * RN01: Apenas Técnico de Segurança pode cadastrar treinamentos obrigatórios
     * RH pode criar treinamentos de outras áreas
     * Admin tem acesso total
     */
    public function create(User $user): bool
    {
        // Admin tem acesso total
        if ($user->tipo === 'admin') {
            return true;
        }

        // Técnico de Segurança pode criar qualquer treinamento
        if ($user->tipo === 'tecnico_seguranca') {
            return true;
        }

        // RH pode criar treinamentos (mas não obrigatórios de segurança)
        if ($user->tipo === 'rh') {
            return true;
        }

        return false;
    }

    /**
     * Verifica se o usuário pode criar treinamentos obrigatórios
     * RN01: Apenas Técnico de Segurança pode cadastrar treinamentos obrigatórios
     */
    public function createObrigatorio(User $user): bool
    {
        // Admin tem acesso total
        if ($user->tipo === 'admin') {
            return true;
        }

        // Apenas Técnico de Segurança pode criar treinamentos obrigatórios
        return $user->tipo === 'tecnico_seguranca';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Treinamento $treinamento): bool
    {
        // Admin tem acesso total
        if ($user->tipo === 'admin') {
            return true;
        }

        // Técnico de Segurança pode editar qualquer treinamento
        if ($user->tipo === 'tecnico_seguranca') {
            return true;
        }

        // RH pode editar treinamentos (mas não pode alterar treinamentos obrigatórios para obrigatórios)
        if ($user->tipo === 'rh') {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Treinamento $treinamento): bool
    {
        // Apenas Admin e Técnico de Segurança podem deletar
        return in_array($user->tipo, ['admin', 'tecnico_seguranca']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Treinamento $treinamento): bool
    {
        return $user->tipo === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Treinamento $treinamento): bool
    {
        return $user->tipo === 'admin';
    }
}
