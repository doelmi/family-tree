<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AccessRightMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$role)
    {
        if(!in_array(Auth::user()->detail->role->code, $role)) {
            return back()->with('error', 'Anda tidak memiliki akses untuk membuka halaman ini');
        }
        return $next($request);
    }
}
