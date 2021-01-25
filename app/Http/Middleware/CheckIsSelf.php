<?php

namespace App\Http\Middleware;

use App\Models\Product;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIsSelf
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
        $product = $request->route('product');

        if (Auth::user()->id == $product->user->id) {
            return $next($request);
        }

        else {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
}