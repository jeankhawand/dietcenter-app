<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Webpatser\Uuid\Uuid;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //check that app is local
        //suppprt migration editing
        Passport::ignoreMigrations();
        if ($this->app->isLocal()) {
            //if local register your services you require for development
            $this->app->register('Barryvdh\Debugbar\ServiceProvider');
        } else {
            //else register your services you require for production
            $this->app['request']->server->set('HTTPS', true);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Client::creating(function (Client $client) {
        //     $client->incrementing = false;
        //     $client->id = Client::generateUuid();;
        // });
        // Client::retrieved(function (Client $client) {
        //     $client->incrementing = false;
        // });
    

    }
}
