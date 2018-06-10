<?php

namespace Facades\App\Services\Assignments;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Services\Assignments\SubmitService
 */
class SubmitService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Services\Assignments\SubmitService';
    }
}
