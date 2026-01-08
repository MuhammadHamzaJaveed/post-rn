<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        $roles = [
            config('role_names.roles.super_admin'),
            config('role_names.roles.admin'),
            config('role_names.roles.incharge-team'),
            config('role_names.roles.verification-team'),
            config('role_names.roles.supervisory-team'),
            config('role_names.roles.college'),
        ];

        if (Auth::user()->hasRole($roles) || Auth::user()->email == 'adminbig@uhs.com' || Auth::user()->email == 'adminImageUpload@uhs.com') {
            return redirect('/admin');
        }

        return $next($request);
    }
}
