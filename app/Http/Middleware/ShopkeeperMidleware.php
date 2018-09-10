<?php

namespace App\Http\Middleware;

use Closure;

class ShopkeeperMidleware
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
        if( is_null($request->user()->shop) )
            return $next($request);
        else 
            return redirect( route('shop.edit', $request->user()->shop->id) );
    }
}
