<?php

namespace EasyPanel\Directives;

use EasyPanel\Contracts\Directivable;

class UrlDirective implements Directivable
{
    public static function handle(string $name, array $parameters = [])
    {
        return '<?php echo url(' . $name . ') ?>';
    }
}