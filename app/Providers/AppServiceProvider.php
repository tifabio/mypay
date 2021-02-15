<?php

namespace App\Providers;

use App\Manager\AuthorizerManager;
use App\Manager\NotifierManager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('authorizer', function ($app) {
            return new AuthorizerManager($app);
        });
        $this->app->singleton('notifier', function ($app) {
            return new NotifierManager($app);
        });
    }
}
