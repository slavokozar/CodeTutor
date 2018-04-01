<?php

namespace Facades\App\Services\Users;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Services\Users\GroupService
 */
class GroupService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Services\Users\GroupService';
    }
}
