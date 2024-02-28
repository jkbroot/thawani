<?php

namespace Jkbroot\Thawani;

use Illuminate\Support\Facades\Facade;

class ThawaniPayFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'thawani'; // This should match the alias you'll set in your service provider
    }
}
