<?php

namespace App\Http\Middleware;

use Closure;

class isAdmin
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
        if(auth()->check() && $request->user()->role == 'Encoder'){
            return redirect()->guest('encoder.home');
        }else if(auth()->check() && $request->user()->role == 'Administrator'){
            return redirect()->guest('admin.home');
        }else {

        }
        return $next($request);
    }
}
