<?php

namespace ILDaviz\LaravelPhpseclib;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ILDaviz\LaravelPhpseclib\Skeleton\SkeletonClass
 */
class LaravelPhpseclibFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-phpseclib';
    }
}
