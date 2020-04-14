<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Admin extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('admin.login');
        }
    }

    protected function authenticate($request, array $guards)
    {
        $guard = 'admin';
        if ($this->auth->guard($guard)->check()) {
            return $this->auth->shouldUse($guard);
        }else{
            $this->unauthenticated($request, $guards);
        }
    }
}
