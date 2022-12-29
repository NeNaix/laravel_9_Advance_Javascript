<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role 
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {   

        if (auth()->user() == null) {
            return response(['success' = false]);
        }
        
        foreach($roles as $role) {
        
        if (auth()->user()->role == $role) {
             return $next($request);
        }
        
        return redirect()->route('dash');
    }
}
