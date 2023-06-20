<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->role == 'viewer') 
        {
            if($request->method() == 'GET') 
            {
                return $next($request);
            }
        }
        else if(auth()->user()->role == 'editor')
        {
            if($request->method() == 'GET' || $request->method() == 'PUT') 
            {
                return $next($request);
            }
        }
        else if(auth()->user()->role == 'admin')
        {
            return $next($request);
        }
        return response()->json(['error','Permission Denied!!! You do not have administrative access.']);
    }
}
