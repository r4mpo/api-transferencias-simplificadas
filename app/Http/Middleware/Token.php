<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class Token
{
    public function handle($request, Closure $next): JsonResponse
    {
        $data_response = [
            'response' => 'Token inválido.',
            'response_code' => 333
        ];

        try {
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                return response()->json($data_response, 401);
            }

            $token_type = JWTAuth::getPayload()->get('type');

            if ($token_type === 'Refresh' && !$this->route_refresh($request)) {
                return response()->json($data_response, 401);
            }
        } catch (JWTException $e) {
            return response()->json($data_response, 401);
        }

        return $next($request);
    }

    private function route_refresh($request): bool
    {
        return $request->is('api/user/refresh');
    }
}
