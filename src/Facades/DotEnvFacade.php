<?php

namespace Farshadth\DotEnv\Facades;

use Farshadth\DotEnv\DotEnv;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Farshadth\DotEnv\DotEnv
 */
class DotEnvFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return DotEnv::class;
    }
}
