<?php

namespace App\Http\Middleware;

use App\Libraries\Utils;
use Closure;

class CustomerAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(\Auth::user()->slug!='customer')
        {
            return redirect()->to('/customer/login');
        }
        return $next($request);
    }
}
