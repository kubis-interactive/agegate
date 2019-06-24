<?php

namespace Kubis\AgeGate;

use Illuminate\Support\ServiceProvider;

class AgeGateServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMiddleware();

        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'kubis');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'agegate');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    public function registerMiddleware(){
        $this->app['router']
            ->aliasMiddleware('age-gate', \Kubis\AgeGate\Middleware\AgeGate::class);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/agegate.php', 'agegate');

        // Register the service the package provides.
        $this->app->singleton('agegate', function ($app) {
            return new AgeGate;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['agegate'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/agegate.php' => config_path('agegate.php'),
        ], 'agegate-config');

        // Publishing the views.
        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/kubis/agegate'),
        ], 'agegate-views');

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/kubis'),
        ], 'agegate.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/kubis'),
        ], 'agegate.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
