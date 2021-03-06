<?php

namespace EasyPanel\Directives;

use EasyPanel\Contracts\Directivable;

class ConfigDirective implements Directivable
{
    public static function handle($parameter)
    {
        return "<?php echo config({$parameter}) ?>";
    }
}