<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EmailVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (empty(Auth::user())):
            return  redirect()->route('login');
        endif;
        $user=Auth::user();
        if (!$user->email_verified):
            return redirect()->route('login');
        endif;
        return $next($request);
    }
}
