<?php

namespace EasyPanel\Directives;

use EasyPanel\Contracts\Directivable;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class isActiveDirective implements Directivable
{
    public static function handle(string $name, array $parameters = [])
    {
        return "<?php echo EasyPanel\\Directives\\isActiveDirective::render($name) ?>";
    }

    public static function render($list, $type = 'active', $else = '')
    {
        if (is_array($list)) {
            return (in_array(Route::getCurrentRoute()->getName(), $list)) ? $type : $else;
        }

        return Str::is($list, Route::getCurrentRoute()->getName()) ? $type : $else;
    }

}