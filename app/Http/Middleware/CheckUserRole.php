<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // return $next($request);

        if(Auth::check())
        {
            $prefix = $request->route()->getPrefix();
            if($prefix == '/admin')
            {
                if(Auth::user()->isUser())
                {
                    return redirect()->route('user.dashboard');
                }

                if(Auth::user()->isAgency())
                {
                    return redirect()->route('agency.dashboard');
                }
            }else if($prefix == '/user')
            {
                if(Auth::user()->isAdmin())
                {
                    return redirect()->route('admin.dashboard');
                }

                if(Auth::user()->isAgency())
                {
                    return redirect()->route('agency.dashboard');
                }                
            }else if($prefix == '/agency')
            {
                if(Auth::user()->isAdmin())
                {
                    return redirect()->route('admin.dashboard');
                }

                if(Auth::user()->isUser())
                {
                    return redirect()->route('user.dashboard');
                }                
            }
        }


        return $next($request);
    }
}
