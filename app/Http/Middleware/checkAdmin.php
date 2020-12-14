<?php

namespace App\Http\Middleware;

use Closure;


class checkAdmin
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
        if($request->session()->has('nhanvien')){
            return $next($request);
        }  
        return redirect('/loginad')->with('loi', 'Bạn không có quyền admin');
    }

}
