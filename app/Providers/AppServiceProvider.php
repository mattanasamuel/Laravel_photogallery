<?php

namespace App\Providers;

use App\Models\Album;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        //l'id dell'utente loggato deve coincidere con l'utente dell'album
        Gate::define('manage-album', function(User $user, Album $album){
            return $user->id === $album->user_id;
        });
    }
}
