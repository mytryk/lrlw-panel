<?php

namespace EasyPanel\Contracts;

interface Directivable
{
    public static function handle($parameter);
}