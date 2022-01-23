<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CekProktorLogin
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
        if(!Session::get('is_proktor_login')){
            return redirect('admin/login')->with('error','Anda Harus Login Terlebih Dahulu');
        }
        return $next($request);
    }
}
