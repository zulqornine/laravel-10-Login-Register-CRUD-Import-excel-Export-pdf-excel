<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $level)
    {
        // Mengecek apakah user login dan memiliki level yang sesuai
        if (Auth::check() && Auth::user()->level === $level) {
            return $next($request);
        }

        // Jika tidak sesuai, arahkan ke halaman yang diinginkan (misalnya halaman login atau error)
        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini');
    }
}
