<?php

namespace App\Swagger\Usuario;

/**
 * @OA\Get(
 *     path="/usuario/logout",
 *     summary="Fazer logout do usuário",
 *     tags={"Autenticação"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Response(
 *         response=111,
 *         description="Logout bem-sucedido",
 *         @OA\JsonContent(
 *             @OA\Property(property="resposta", type="string", example="Usuário desconectado com sucesso."),
 *             @OA\Property(property="codigo_resposta", type="integer", example=111)
 *         )
 *     )
 * )
 */

class LogoutResponse
{
}