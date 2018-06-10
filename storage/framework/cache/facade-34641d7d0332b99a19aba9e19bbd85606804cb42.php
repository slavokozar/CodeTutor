<?php

namespace Facades\App\Services\Links;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Services\Links\LinkService
 */
class LinkService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Services\Links\LinkService';
    }
}
