<?php

namespace Future\Notifications;


use Future\Notifications\Future\NotificationIcon;
use Future\Notifications\Future\NotiList;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class NotificationsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        Livewire::component('future::notifications.icon', NotificationIcon::class);
        Livewire::component('future::notifications', NotiList::class);
         $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'future');
         $this->loadViewsFrom(__DIR__.'/../resources/views', 'future');
         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

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
        $this->mergeConfigFrom(__DIR__ . '/../config/notifications.php', 'notifications');

        // Register the service the package provides.
        $this->app->singleton('notifications', function ($app) {
            return new NotiList;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['notifications'];
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
            __DIR__ . '/../config/notifications.php' => config_path('notifications.php'),
        ], 'notifications.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/future'),
        ], 'notifications.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/future'),
        ], 'notifications.assets');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/future'),
        ], 'notifications.lang');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
