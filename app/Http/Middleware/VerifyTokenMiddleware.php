<?php

namespace App\Http\Middleware;

use JWTAuth;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $request['user'] = [
                'id' => $user->id,
                'name' => $user->name,
            ];

            return $next($request);
        } catch (Exception $err) {
            return response()->json([
                'code' => 401,
                'message' => 'Unauthorized',
            ], 401);
        }
    }
}
