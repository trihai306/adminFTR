<?php

namespace Future\Core;

use Future\Core\Livewire\Admin\MenuHeader;
use Future\Core\Livewire\Admin\Notifications\NotificationIcon;
use Future\Core\Livewire\Admin\Notifications\Notifications;
use Future\Core\Livewire\Admin\Profile;
use Future\Core\Livewire\Auth\ForgotPassword;
use Future\Core\Livewire\Auth\Login;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;


class CoreServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        Livewire::component('future::livewire.auth.login', Login::class);
        Livewire::component('future::future.forgot-password', ForgotPassword::class);
        Livewire::component('future::livewire.admin.menu-header', MenuHeader::class);
        Livewire::component('future::livewire.admin.notifications', Notifications::class);
        Livewire::component('future::livewire.admin.notifications.icon', NotificationIcon::class);
        Livewire::component('future::livewire.admin.profile', Profile::class);
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'future');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'future');
         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
         $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
        \Route::fallback(function () {
            return view('future::404');
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/future.php', 'future');
        // Register the service the package provides.
        $this->app->singleton('core', function ($app) {
            return new Core;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['core'];
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
            __DIR__.'/../config/core.php' => config_path('core.php'),
        ], 'core.config');

        // Publishing the migration files.
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'core.migrations');
        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/future'),
        ], 'core.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/future'),
        ], 'core.assets');*/

        // Publishing the translation files.
        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/future'),
        ], 'core.lang');

        // Registering package commands.
        // $this->commands([]);
    }
}
