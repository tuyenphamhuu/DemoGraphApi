<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Facebook\Facebook;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->singleton(Facebook::class, function ($app) {
            return new Facebook(config('facebook.config'));
        });
        $this->app->bind(
            'App\Repositories\Contracts\UserInterface',
            'App\Repositories\Eloquents\UserRepository'
        );
    }
}
