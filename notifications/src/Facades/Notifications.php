<?php

namespace Future\Notifications\Facades;

use Illuminate\Support\Facades\Facade;

class Notifications extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'notifications';
    }
}
