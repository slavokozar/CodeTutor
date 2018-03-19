<?php

namespace Facades\App\Services\Users\Groups;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Services\Users\Groups\SchoolService
 */
class SchoolService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Services\Users\Groups\SchoolService';
    }
}
