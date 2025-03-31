<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class Token
{
    public function handle($requisicao, Closure $proximo): JsonResponse
    {
        $dados_resposta = [
            'resposta' => 'Token inválido.',
            'codigo_resposta' => 333
        ];

        try {
            $usuario = JWTAuth::parseToken()->authenticate();

            if (!$usuario) {
                return response()->json($dados_resposta, 401);
            }

            $tipo_token = JWTAuth::getPayload()->get('type');

            if ($tipo_token === 'Refresh' && !$this->rota_recarregar($requisicao)) {
                return response()->json($dados_resposta, 401);
            }
        } catch (JWTException $e) {
            return response()->json($dados_resposta, 401);
        }

        return $proximo($requisicao);
    }

    private function rota_recarregar($requisicao): bool
    {
        return $requisicao->is('api/usuario/recarregar');
    }
}
