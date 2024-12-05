<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class loginlevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$levels): Response
    {
        $page_name = $request->route()->getName() ?? 'halaman tidak dikenal'; 

        if(in_array($request->user()->nama_role, $levels))
        {
            return $next($request);
        }
        return back()->with('error', 'Anda tidak berwenang untuk mengakses halaman ' . $page_name);
    }
}
