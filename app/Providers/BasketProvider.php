<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Lenius\Basket\Basket;
use Lenius\Basket\Identifier\Cookie;
use Lenius\Basket\Storage\Session;

class BasketProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('basket', function ($app) {
            return new Basket(new Session, new Cookie);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['basket'];
    }
}
