<?php

namespace ILDaviz\LaravelPhpseclib;

use Illuminate\Support\ServiceProvider;

class LaravelPhpseclibServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Register the main class to use with the facade
        $this->app->singleton('LaravelPhpseclib', function () {
            return new LaravelPhpseclib;
        });
    }
}
