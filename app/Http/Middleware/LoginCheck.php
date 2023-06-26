<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class LoginCheck
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
        
        // if(Auth::user()!=null){
        //     return redirect('/home');
        // }else{
        //     return $next($request);
        // }
        // dd($next($request));
    //    dd(Auth::user());
       


    //     $response = $next($request);
    //     return $response->header('Cache-Control','nocache', 'no-store', 'max-age=0', 'must-revalidate')
    //    ->header('Pragma','no-cache');


    $response = $next($request);
    $response->headers->set('cache-control','nocache, no-store, max-age=0, must-revalidate');
    $response->headers->set('Pragma','no-cache');
    $response->headers->set('Expires','Sun, 02 Jan 1990 00:00:00 GMT');
    return $response;
    }
}
