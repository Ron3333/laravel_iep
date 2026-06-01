<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate; // <-- Agregar esta línea
use App\Models\User;// <-- Agregar esta línea

class AppServiceProvider extends ServiceProvider
{
   // public const HOME = '/dashboard';
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
        // Gate para proteger la edición/visualización de usuarios
        // Un editor solo puede ver/editar usuarios que NO son administradores
        Gate::define('update-view-user-admin', function ($user, $userParam) {
            //echo "Usuario autenticado: {$user->name} ({$user->rol}), Usuario a editar/ver: {$userParam->name} ({$userParam->rol})\<bt>";
            return $user->hasRole('Admin') || !$userParam->hasRole('Admin');
        });

        // Gate para verificar si es administrador
        Gate::define('is-admin', function ($user) {
            return $user->hasRole('Admin');
        });
    }
}
