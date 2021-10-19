<?php

namespace EasyPanel\Directives;

use EasyPanel\Contracts\Directivable;

class CountDirective implements Directivable
{
    public static function handle(string $name, array $parameters = [])
    {
        preg_match('/((\[.*?\])|(\$.*))\s?,\s?(\d+)?/', $name, $match);
        $count = $match[4] ?? 1;
        [$collection, $count] = [$match[1], $count];
        return "<?php if(count({$collection}) >= {$count}): ?>";
    }
}