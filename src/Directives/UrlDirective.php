<?php

namespace EasyPanel\Directives;

use EasyPanel\Contract\Directivable;

class UrlDirective implements Directivable
{
    public static function handle($parameter)
    {
        return '<?php echo url(' . $parameter . ') ?>';
    }
}