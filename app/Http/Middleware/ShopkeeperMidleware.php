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
        /**
         * Verifies that the User has and store, otherwise sends him to the create store action
         * And verifies that a User can't have more than one store
         */
        if( !$request->user()->hasShop() ){
            if($request->url() != route('shop.create') and 
                $request->url() != route('shop.store') )
            return redirect( route('shop.create') );
        } else {
            if($request->url() == route('shop.create') or
                $request->url() == route('shop.store')  ){
                    return redirect( route('shop.edit', $request->user()->getShopId() ) );
            }
        }

        return $next($request);
        
    }
}
