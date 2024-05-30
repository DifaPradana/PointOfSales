<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class AccountStatusChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah pengguna sudah login dan status akun adalah "aktif"
        if (Auth::check() && Auth::user()->status !== 'Aktif') {
            // Redirect pengguna ke halaman tertentu dengan pesan error
            Alert::error('Error', 'Akun Anda tidak aktif. Silakan hubungi admin untuk informasi lebih lanjut.');
            return redirect()->route('reseller.produk');
        }

        return $next($request);
    }
}
