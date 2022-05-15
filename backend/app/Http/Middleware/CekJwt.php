<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class CekJwt
{

    public function handle($request, Closure $next)
    {
        $authorization = $request->header('Authorization');
        if(!$authorization) {
            return response()->json(['message' => 'Token was not provided.'], 401);
        }

        $explode = explode(' ', $authorization);
        if(!isset($explode[1])) {
            return response()->json(['message' => 'Invalid token.'], 401);
        }

        $jwt = $explode[1];

        try {
            $key = 'Tsd99nnmSgadgdhsagdsagdaghdksao7qwsdadsaCMdsadsa';
            $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Token was not correct, please log in again.'], 401);
        }
        return $next($request);
    }
}
