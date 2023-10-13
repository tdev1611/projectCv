<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\IpAddress;

class CreateIp
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
        $ip = $request->ip();
        $exsitIp = IpAddress::where('ip', $ip)->first();
        if ($exsitIp and $exsitIp->user_id === null) {
            $exsitIp->user_id = auth()->user() ? auth()->user()->id : null;
            $exsitIp->save();
        }
        if (!$exsitIp) {
            $newIP = new IpAddress();
            $newIP->ip = $ip;
            $newIP->user_id = auth()->user() ? auth()->user()->id : null;
            $newIP->save();
        }

        return $next($request);
    }
}
