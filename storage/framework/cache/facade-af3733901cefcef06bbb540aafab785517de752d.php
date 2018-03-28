<?php

namespace Facades\App\Services\Articles;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Services\Articles\ArticleService
 */
class ArticleService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Services\Articles\ArticleService';
    }
}
