<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {

        if(auth()->user())
        {

            $curr_route_name = Route::getRoutes()->match($request)->getName();

            $array_val = auth()->user()->getAllPermissions()->pluck('route_name')->toArray();

            $array_permitted_route =explode(',',implode(',',$array_val));

            if(auth()->user()->hasRole('Super Admin'))
            {
                return $next($request);
            }
            else if(auth()->user()->getAllPermissions()->contains('route_name',$curr_route_name))
            {
                return $next($request);
            }
            else if(in_array($curr_route_name,$array_permitted_route))
            {
                return $next($request);
            }
            else{
                abort(404);
            }
        }
        else
        {
            return $next($request);
        }
    }
}
