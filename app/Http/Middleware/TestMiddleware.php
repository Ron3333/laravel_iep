<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $id =  $request->route('id');
        if($id == 20){
            return $next($request);
        }else{
            return redirect("/");
        }
        
        //return $next($request);
    }
}
