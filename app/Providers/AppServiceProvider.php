<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
        Gate::define('admin+apoteker+pengawas+resepsionis', function(User $user) {
            return (in_array($user->nama_role,['admin','apoteker', 'pengawas', 'resepsionis']));
        });
        Gate::define('admin+apoteker', function(User $user) {
            return (in_array($user->nama_role,['admin','apoteker']));
        });
        Gate::define('admin+pengawas', function(User $user) {
            return (in_array($user->nama_role,['admin','pengawas']));
        });
        Gate::define('admin', function(User $user) {
            return $user->nama_role === 'admin';
        });
        Gate::define('dokter', function(User $user) {
            return $user->nama_role === 'dokter';
        });
        Gate::define('apoteker', function(User $user) {
            return $user->nama_role === 'apoteker';
        });
        Gate::define('pengawas', function(User $user) {
            return $user->nama_role === 'pengawas';
        });
        Gate::define('resepsionis', function(User $user) {
            return $user->nama_role === 'resepsionis';
        });

        Paginator::useBootstrap();
    }
}
