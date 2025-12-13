<?php

namespace App\Policies;

use App\Models\Turma;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TurmaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Admin, Técnico de Segurança, RH, Instrutor podem visualizar
        return in_array($user->tipo, ['admin', 'tecnico_seguranca', 'rh', 'instrutor']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Turma $turma): bool
    {
        // Admin, Técnico de Segurança, RH, Instrutor podem visualizar
        // Instrutor só pode ver suas próprias turmas
        if ($user->tipo === 'instrutor') {
            return $turma->instrutor_id === $user->id;
        }

        return in_array($user->tipo, ['admin', 'tecnico_seguranca', 'rh']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Admin, Técnico de Segurança e RH podem criar participações
        return in_array($user->tipo, ['admin', 'tecnico_seguranca', 'rh']);
    }

    /**
     * Determine whether the user can update the model.
     * RN02: Instrutores, Técnicos de Segurança e RH podem registrar presença
     */
    public function update(User $user, Turma $turma): bool
    {
        // Admin tem acesso total
        if ($user->tipo === 'admin') {
            return true;
        }

        // RN02: Instrutores podem registrar presença nas suas turmas
        if ($user->tipo === 'instrutor') {
            return $turma->instrutor_id === $user->id;
        }

        // RN02: Técnico de Segurança pode registrar presença
        if ($user->tipo === 'tecnico_seguranca') {
            return true;
        }

        // RN02: RH pode registrar presença
        if ($user->tipo === 'rh') {
            return true;
        }

        return false;
    }

    /**
     * Verifica se o usuário pode registrar presença
     * RN02: Instrutores, Técnicos de Segurança e RH podem registrar presença
     */
    public function registrarPresenca(User $user, Turma $turma): bool
    {
        // Admin tem acesso total
        if ($user->tipo === 'admin') {
            return true;
        }

        // RN02: Instrutores podem registrar presença nas suas turmas
        if ($user->tipo === 'instrutor') {
            return $turma->instrutor_id === $user->id;
        }

        // RN02: Técnico de Segurança pode registrar presença
        if ($user->tipo === 'tecnico_seguranca') {
            return true;
        }

        // RN02: RH pode registrar presença
        if ($user->tipo === 'rh') {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Turma $turma): bool
    {
        // Apenas Admin pode deletar
        return $user->tipo === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Turma $turma): bool
    {
        return $user->tipo === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Turma $turma): bool
    {
        return $user->tipo === 'admin';
    }
}
