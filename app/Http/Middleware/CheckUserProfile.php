<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Closure;


class CheckUserProfile
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
        // if ($request->route()->named('users.profile-form'))
        // $user->has_filled_profile == false && 

        $user = Auth::user();
        $route = Route::currentRouteName();
       
        if($route !== "users.profile-form") {
            if ($user->has_filled_profile == false) {
                return redirect()->route('users.profile-form', $user->id); 
            }             
        }
        return $next($request);

    }
}
