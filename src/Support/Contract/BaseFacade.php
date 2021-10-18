<?php

namespace EasyPanel\Support\Contract;

use Illuminate\Support\Facades\Facade;

class BaseFacade extends Facade
{
    public static function shouldProxyTo($class)
    {
        app()->singleton(static::getFacadeAccessor(), $class);
    }

    protected static function getFacadeAccessor()
    {
        return static::class;
    }
}
