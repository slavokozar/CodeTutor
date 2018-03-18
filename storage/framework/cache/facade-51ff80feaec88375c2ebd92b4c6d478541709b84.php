<?php

namespace Facades\App\Services\Users\Schools;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Services\Users\Schools\StudentService
 */
class StudentService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Services\Users\Schools\StudentService';
    }
}
