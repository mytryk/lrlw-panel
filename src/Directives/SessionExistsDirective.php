<?php

namespace EasyPanel\Directives;

use EasyPanel\Contract\Directivable;

class SessionExistsDirective implements Directivable
{
    public static function handle($parameter)
    {
        return "<?php if(session()->exists({$parameter})): ?>";
    }
}