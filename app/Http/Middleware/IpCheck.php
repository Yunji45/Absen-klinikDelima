<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IpCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,...$ips)
    {
        // $access = array_filter(array_map(function($v){
        //     return ( $star = strpos($v, '*') ) ? ( substr(request()->ip(), 0, $star) == substr($v, 0, $star) )
        //                                        : ( request()->ip() == $v );
        // }, $ips));

        // return $access ? $next($request) : App::abort(403);
        $access = array_filter($ips, function ($ip) use ($request) {
            if (strpos($ip, '*') !== false) {
                $pattern = '/^' . str_replace('*', '.*', $ip) . '$/';
                return preg_match($pattern, $request->ip());
            } else {
                return $request->ip() === $ip;
            }
        });
    
        if (!empty($access)) {
            return $next($request);
        } else {
            abort(403);
        }
    }
}
