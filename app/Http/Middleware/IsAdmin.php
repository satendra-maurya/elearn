<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::User()) {
            $input = $request->all();
            array_walk_recursive($input, function(&$input) {
                $input = strip_tags(trim($input));
            });

            $request->merge($input);
            return $next($request);
        }
        return redirect('/');
    }

}
