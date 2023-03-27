<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLastLoginMiddleware
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
        $previous_session = Auth::user()->session_id;
        $request->session()->put('ip_address', Auth::user()->ip_address);
        if (
            $previous_session !== Session::getId() || Session::get('ip_address') !== Auth::user()->ip_address
        ) {
            Session::getHandler()->destroy($previous_session);
            $request->session()->regenerate();
            $user = User::find(Auth::user()->id);
            if (!$user->session_id && !$user->ip_address) {
                $user->session_id =  Session::getId();
                $user->ip_address = $request->ip();
                $user->save();
            }
        }
        return $next($request);
    }
}
