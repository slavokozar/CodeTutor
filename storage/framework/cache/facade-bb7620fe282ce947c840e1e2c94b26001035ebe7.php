<?php

namespace Facades\App\Services\Files;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Services\Files\ImageService
 */
class ImageService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Services\Files\ImageService';
    }
}
