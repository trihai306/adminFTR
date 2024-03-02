<?php

namespace Future\Widgets;

use Illuminate\Support\ServiceProvider;

class WidgetsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
         $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'widget');
         $this->loadViewsFrom(__DIR__.'/../resources/views', 'widget');
         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
//         $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/widgets.php', 'widgets');

        // Register the service the package provides.
        $this->app->singleton('widgets', function ($app) {
            return new Widgets;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['widgets'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/widgets.php' => config_path('widgets.php'),
        ], 'widgets.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/trihai306'),
        ], 'widgets.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/trihai306'),
        ], 'widgets.assets');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/trihai306'),
        ], 'widgets.lang');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
