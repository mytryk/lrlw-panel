<?php

namespace EasyPanel\Directives;

use EasyPanel\Contracts\Directivable;

class UrlDirective implements Directivable
{
    public static function handle($parameter)
    {
        return '<?php echo url(' . $parameter . ') ?>';
    }
}