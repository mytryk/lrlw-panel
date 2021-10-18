<?php

namespace EasyPanel\Directives;

use EasyPanel\Contracts\Directivable;

class AssetDirective implements Directivable
{
    public static function handle($parameter)
    {
        return '<?php echo asset(' . $parameter . ') ?>';
    }
}