<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use App\Models\LogAccessUser;
class LogAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $ip = $request->server->get("REMOTE_ADDR");
        $rota = $request->getRequestUri();
        LogAccessUser::create(['log'=>"IP $ip requisitou a rota $rota"]);
        return $next($request);


    }
}
