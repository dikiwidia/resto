<?php

namespace App\Http\Middleware\Resto;

use Closure;

class RedirectIfNoSession
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
        if(!$request->session()->has('authenticated')){
            //$loginpage = route('login.index');
            return redirect()->route('login.index');
        }
        //dd('success');
        return $next($request);
    }
}
