<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class Authentication {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $route = $request->route();
        $uri = $route->uri;
        //print_r($uri);exit;
        //dd($uri);
        
        //dd($request);
        
        $public_links = [
            '/',
            'check_login',
            'login',
            'register',
            'save_user',
            'register/{token}',
        ];

        if(has_logged_in() && in_array($uri, $public_links) && $uri != 'logout'){
            return redirect('notes');
        }

        else if (!has_logged_in() && !in_array($uri, $public_links)) {
            return redirect('/');
        }

        /*if(has_logged_in() && in_array($uri, ['register'])){
            return redirect('/');
        }*/

        
        
        
        return $next($request);
    }

}
