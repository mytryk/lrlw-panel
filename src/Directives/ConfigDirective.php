<?php

namespace EasyPanel\Directives;

use EasyPanel\Contracts\Directivable;

class ConfigDirective implements Directivable
{
    public static function handle(string $name, array $parameters = [])
    {
        return "<?php echo config({$name}) ?>";
    }
}