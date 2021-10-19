<?php

namespace EasyPanel\Directives;

use EasyPanel\Contracts\Directivable;

class EndConditionDirective implements Directivable
{
    public static function handle(string $name, array $parameters = [])
    {
        return '<?php endif; ?>';
    }
}