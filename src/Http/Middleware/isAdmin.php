<?php

namespace EasyPanel\Http\Middleware;

use Closure;
use EasyPanel\Support\Contract\AuthFacade;

class isAdmin
{

    public function handle($request, Closure $next)
    {
        if (auth()->guest()) {
            return redirect(config('easy_panel.redirect_unauthorized'));
        }

        if (!AuthFacade::checkIsCRUDPanelAdmin(auth()->user()->id)) {
            return redirect(config('easy_panel.redirect_unauthorized'));
        }

        return $next($request);
    }

}
