<?php

namespace EasyPanel\Directives;

use EasyPanel\Contracts\Directivable;

class OldDirective implements Directivable
{
    public static function handle($parameter)
    {
        $array = explode(',', $parameter);
        $oldValue = trim($array[0]);
        $secondParam = trim(@$array[1]);
        if ($secondParam) {
            return "<?php echo old({$oldValue}, {$secondParam}) ?>";
        }

        return "<?php echo old({$oldValue}) ?>";
    }
}