<?php

namespace EasyPanel\Directives;

use EasyPanel\Contracts\Directivable;

class UserDirective implements Directivable
{
    public static function handle($parameter)
    {
        $parameter = str_replace(['"', "'"], null, $parameter);

        return "<?php if(\auth()->check()): echo \auth()->user()->{$parameter}; endif; ?>";
    }
}