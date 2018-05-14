<?php

namespace App\Http\Middleware;

use App\Product;
use Closure;
use Illuminate\Support\Facades\Auth;

class OwnsProduct
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
        if(Product::find($request->id)->user_id == Auth::id()){
            return $next($request);
        } else {
            return redirect('/home');
        }

    }
}
