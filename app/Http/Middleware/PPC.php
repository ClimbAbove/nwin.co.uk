<?php

namespace App\Http\Middleware;
use App\DTOs\PPCDTO;
use Closure;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class PPC
{
    public function handle(Request $request, Closure $next)
    {

        $PPCDTO = new PPCDTO();

        session(['_ppc' => serialize($PPCDTO)]);

        return $next($request);
    }

}
