<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CekSiswaLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Session::get('is_siswa_login')){
            return redirect('test/login')->with('error','Anda Harus Login Terlebih Dahulu');
        }
        return $next($request);
    }
}
