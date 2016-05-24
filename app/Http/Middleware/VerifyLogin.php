<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 2016-05-24
 * Time: 18:32
 */

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Session;
use Log;

class VerifyLogin
{
    public function handle($request, Closure $next, $guard = null)
    {
//        if (Auth::guard($guard)->guest()) {
//            if ($request->ajax() || $request->wantsJson()) {
//                return response('Unauthorized.', 401);
//            } else {
//                return redirect()->guest('login');
//            }
//        }
        Log::info("中间件".session('username'));
        if(session('username')==null){
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }

        return $next($request);
    }
}