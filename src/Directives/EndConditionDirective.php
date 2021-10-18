<?php

namespace EasyPanel\Directives;

use EasyPanel\Contract\Directivable;

class EndConditionDirective implements Directivable
{
    public static function handle($parameter)
    {
        return '<?php endif; ?>';
    }
}