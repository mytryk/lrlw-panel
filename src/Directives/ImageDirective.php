<?php

namespace EasyPanel\Directives;

use EasyPanel\Contracts\Directivable;

class ImageDirective implements Directivable
{
    public static function handle(string $name, array $parameters = [])
    {
        $name = str_replace(['"', "'"], null, $name);
        $array = explode(',', $name);
        $photo = trim($array[0]);
        $class = trim(@$array[1]) ?? null;

        return "<img src='" . asset($photo) . "' class='$class'>";
    }

}