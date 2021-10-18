<?php

namespace EasyPanel\Directives;

use EasyPanel\Contract\Directivable;

class AssetDirective implements Directivable
{
    public static function handle($parameter)
    {
        return '<?php echo asset(' . $parameter . ') ?>';
    }
}