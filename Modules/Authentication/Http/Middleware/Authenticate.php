<?php

namespace Modules\Authentication\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if (str_contains($request->route()->getName(), "dashboard")) {
                return route('dashboard.login.view');
            }

            // return route('frontend.home.index');
        }
        
    }
}
