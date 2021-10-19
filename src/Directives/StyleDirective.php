<?php

namespace EasyPanel\Directives;

use EasyPanel\Contracts\Directivable;

class StyleDirective implements Directivable
{
    public static function handle(string $name, array $parameters = [])
    {
        $name = str_replace(['"', "'"], null, $name);

        return "<link href='{$name}' rel='stylesheet'>";
    }
}