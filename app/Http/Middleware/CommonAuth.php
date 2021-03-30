<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CommonAuth {

    public function handle($request, Closure $next) {
        
        $request->merge([
            'app_user_id' => Session::get('2do_user_id'),
        ]);
        
        return $next($request);
    }

}
