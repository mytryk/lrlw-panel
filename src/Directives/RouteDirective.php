<?php

namespace EasyPanel\Directives;

use EasyPanel\Contracts\Directivable;

class RouteDirective implements Directivable
{
    public static function handle($parameter)
    {
        return '<?php echo route(' . $parameter . ') ?>';
    }
}