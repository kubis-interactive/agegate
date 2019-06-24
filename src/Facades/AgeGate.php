<?php

namespace Kubis\AgeGate\Facades;

use Illuminate\Support\Facades\Facade;

class AgeGate extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'agegate';
    }
}
