<?php

namespace EasyPanel\Directives;

use EasyPanel\Contracts\Directivable;

class AssetDirective implements Directivable
{
    public static function handle(string $name, array $parameters = [])
    {
        return '<?php echo asset(' . $name . ') ?>';
    }
}