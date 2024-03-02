<?php

namespace Trihai306\Widgets\Facades;

use Illuminate\Support\Facades\Facade;

class Widgets extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'widgets';
    }
}
