<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BackToForm
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if ($user->submitted_at !== null) {
            // Comment for after after dashboard
            if($user?->otps?->is_verified == 1)
            {
                return $next($request);
            }
            return redirect()->route('uhs-form-dashboard');
        }

        return $next($request);
    }
}
