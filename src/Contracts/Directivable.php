<?php

namespace EasyPanel\Contracts;

interface Directivable
{
    public static function handle(string $name, array $parameters = []);
}