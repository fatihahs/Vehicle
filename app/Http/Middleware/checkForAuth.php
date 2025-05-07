<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class checkForAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //once login, cannot access login page back
        if($request->url('admin/login')) {
            if(isset(Auth::guard('admin')->user()->name)){ //admin req to login page
                return redirect()->route('admins.dashboard'); //return back to dashboard/index
            }
        }
        return $next($request);
    }
}


