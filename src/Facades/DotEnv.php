<?php

namespace Farshadth\DotEnv\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Farshadth\DotEnv\DotEnv
 */
class DotEnv extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Farshadth\DotEnv\DotEnv::class;
    }
}
