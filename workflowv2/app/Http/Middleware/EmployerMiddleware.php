<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (Auth::user()->type == 2){
            return $next($request);
        }
        $go = '';
        if (Auth::user()->type == 1) {
            $go = "coordinator";
        }

        if (Auth::user()->type == 0) {
            $go = "freelancer";
        }

        return redirect('/'.$go);
    }
}
