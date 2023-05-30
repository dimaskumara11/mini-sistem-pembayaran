<?php

namespace App\Http\Middleware;

use App\Helpers\ResponseHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTokenValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->header('Authorization') !== 'Bearer nlsadfsklm23ml0928mlk890238nmlsasjio323!2') {
            return response()->custom((new ResponseHelper)->responseUnauthorized(__("messages.token_invalid")));
        }
 
        return $next($request);
    }
}
