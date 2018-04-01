<?php

namespace Facades\App\Services\Utils;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Services\Utils\CleanString
 */
class CleanString extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Services\Utils\CleanString';
    }
}
