<?php

namespace EasyPanel\Directives;

use EasyPanel\Contracts\Directivable;

class ScriptDirective implements Directivable
{
    public static function handle($parameter)
    {
        $parameter = str_replace(['"', "'"], null, $parameter);
        $array = explode(',', $parameter);
        $url = trim($array[0]);
        $defer = trim(@$array[1]) ?? null;

        if ($defer) {
            return "<script src='{$url}' defer></script>";
        }

        return "<script src='{$url}'></script>";
    }
}