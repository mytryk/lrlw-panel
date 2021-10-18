<?php

namespace EasyPanel\Directives;

use \EasyPanel\Contract\Directivable;

class RouteDirective implements Directivable
{
    public static function handle($parameter)
    {
        return '<?php echo route(' . $parameter . ') ?>';
    }
}