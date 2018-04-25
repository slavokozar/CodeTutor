<?php

namespace Facades\App\Services;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Services\ShareService
 */
class ShareService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Services\ShareService';
    }
}
