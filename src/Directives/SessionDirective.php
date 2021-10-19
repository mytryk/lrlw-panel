<?php

namespace EasyPanel\Directives;

use EasyPanel\Contracts\Directivable;

class SessionDirective implements Directivable
{
    public static function handle(string $name, array $parameters = [])
    {
        return "<?php if(\session()->exists($name)){ echo \session()->get({$name}); } ?>";
    }
}