<?php

namespace Future\Messages;

use Future\Messages\Future\Messages\MessageIcon;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class MessagesServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        Livewire::component('future::admin.messages.icon', MessageIcon::class);
        Livewire::component('future::messages.messages', \Future\Messages\Future\Messages\Messages::class);
        Livewire::component('future::messages.create-message', \Future\Messages\Future\Messages\CreateMessage::class);
        Livewire::component('future::messages.list-conversation', \Future\Messages\Future\Messages\ListConversation::class);
         $this->loadViewsFrom(__DIR__.'/../resources/views', 'future');
         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
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
        $this->mergeConfigFrom(__DIR__.'/../config/messages.php', 'messages');

        // Register the service the package provides.
        $this->app->singleton('messages', function ($app) {
            return new Messages;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['messages'];
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
            __DIR__.'/../config/messages.php' => config_path('messages.php'),
        ], 'messages.config');

        // Publishing the migration files.
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations'),
        ], 'messages.migrations');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/future'),
        ], 'messages.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/future'),
        ], 'messages.assets');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/future'),
        ], 'messages.lang');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
