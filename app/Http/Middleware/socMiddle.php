<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Societies;
use Symfony\Component\HttpFoundation\Response;

class socMiddle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->input('token');
        $checktoken = Societies::where('login_tokens', $token)->first();

        if(!$checktoken || !$token)
        {
            return response()->json([
            'message' => 'Invalid token'
            ], 401);
        }

        $request->societies = $checktoken;

        return $next($request);
    }
}
