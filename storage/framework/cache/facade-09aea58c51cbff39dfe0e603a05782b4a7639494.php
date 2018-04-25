<?php

namespace Facades\App\Services;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Services\CommentService
 */
class CommentService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Services\CommentService';
    }
}
