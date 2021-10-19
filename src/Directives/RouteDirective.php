<?php

namespace EasyPanel\Directives;

use EasyPanel\Contracts\Directivable;

class RouteDirective implements Directivable
{
    public static function handle(string $name, array $parameters = [])
    {
        return '<?php echo route($name, $parameters) ?>';
    }
}