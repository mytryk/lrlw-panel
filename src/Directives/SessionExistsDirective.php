<?php

namespace EasyPanel\Directives;

use EasyPanel\Contracts\Directivable;

class SessionExistsDirective implements Directivable
{
    public static function handle(string $name, array $parameters = [])
    {
        return "<?php if(session()->exists({$name})): ?>";
    }
}