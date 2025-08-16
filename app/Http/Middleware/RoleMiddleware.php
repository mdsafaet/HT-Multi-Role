<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {

  

       
        if (!auth()->check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unautorized',
            ], 401);
        }

        if (!in_array(auth()->user()->role->name, $roles)) {

  
       
            return response()->json([
                'status' => 'error',
                'message' => 'You do not have access',
            ], 403);
        }

        return $next($request);
    }

}