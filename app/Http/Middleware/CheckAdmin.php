<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek jika pengguna yang sedang login memiliki level Administrator
        if (Auth::check() && Auth::user()->level === 'Administrator') {
            return $next($request);
        }

        // Jika tidak, redirect ke halaman yang diinginkan (misalnya, halaman utama)
        return redirect('/404')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
