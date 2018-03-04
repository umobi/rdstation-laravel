<?php

namespace Umobi\RDStation\Facade;

use Illuminate\Support\Facades\Facade;


class RDStation extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'rdstation';
    }
}