<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PPC
{
    public function handle(Request $request, Closure $next, ...$guards)
    {


        return $next($request);
    }
}
