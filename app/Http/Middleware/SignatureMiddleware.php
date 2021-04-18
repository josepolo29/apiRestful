<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

//Este es un middleware nombrado
class SignatureMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $header = 'X-Name')
    {
        // return $next($request);
        // after middleware -> se ejecuta antes de toda respuesta -> antes de $next
        $response = $next($request);
        //before middleware -> se ejecuta despues de la respuesta -> despues de $next
        $response->headers->set($header, config('app.name'));

        return $response;
    }
}
