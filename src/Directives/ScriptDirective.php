<?php

namespace EasyPanel\Directives;

use EasyPanel\Contracts\Directivable;

class ScriptDirective implements Directivable
{
    public static function handle(string $name, array $parameters = [])
    {
        $name = str_replace(['"', "'"], null, $name);
        $array = explode(',', $name);
        $url = trim($array[0]);
        $defer = trim(@$array[1]) ?? null;

        if ($defer) {
            return "<script src='{$url}' defer></script>";
        }

        return "<script src='{$url}'></script>";
    }
}