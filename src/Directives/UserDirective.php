<?php

namespace EasyPanel\Directives;

use EasyPanel\Contracts\Directivable;

class UserDirective implements Directivable
{
    public static function handle(string $name, array $parameters = [])
    {
        $name = str_replace(['"', "'"], null, $name);

        return "<?php if(\auth()->check()): echo \auth()->user()->{$name}; endif; ?>";
    }
}