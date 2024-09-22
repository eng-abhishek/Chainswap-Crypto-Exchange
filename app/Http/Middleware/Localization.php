<?php

namespace App\Http\Middleware;

use Closure;

class Localization
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
        // if (\Session::has('locale') && array_key_exists(\Session::get('locale'), config('constants.supported_languages'))) {
        //     \App::setLocale(\Session::get('locale'));
        // }

        // if(in_array(\Request::route()->getName(), ['home', 'exchange-tutorials', 'exchange-tutorials-detail', 'about-us'])){

            $segments = $request->segments();
            
            if (count($segments) > 0 && array_key_exists($segments[0], config('constants.supported_languages'))) {
                \App::setLocale($segments[0]);
              
                \URL::defaults(['locale' => $segments[0]]);

                \Session::put('locale', $segments[0]);
            }

            if (count($segments) > 0 && $segments[0] == 'en') {
                array_shift($segments);
                return redirect()->to(implode('/', $segments));
            }   
     //   }

        if ($request->expectsJson() && \Session::has('locale') && array_key_exists(\Session::get('locale'), config('constants.supported_languages'))) {
            \App::setLocale(\Session::get('locale'));
        }

        return $next($request);
    }

}
