<?php

namespace EasyPanel\Directives;

use EasyPanel\Contract\Directivable;

class ConfigDirective implements Directivable
{
    public static function handle($parameter)
    {
        return "<?php echo config({$parameter}) ?>";
    }
}