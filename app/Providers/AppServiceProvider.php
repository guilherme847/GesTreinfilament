<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Treinamento;
use App\Models\Turma;
use App\Models\User;
use App\Policies\TreinamentoPolicy;
use App\Policies\TurmaPolicy;
use App\Policies\UserPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Treinamento::class => TreinamentoPolicy::class,
        Turma::class => TurmaPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Registrar as Policies
        Gate::policy(Treinamento::class, TreinamentoPolicy::class);
        Gate::policy(Turma::class, TurmaPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
    }
}
