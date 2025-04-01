<?php

namespace App\Swagger\Usuario;

/**
 * @OA\Get(
 *     path="/user/logout",
 *     summary="Fazer logout do usuário",
 *     tags={"Autenticação"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Response(
 *         response=111,
 *         description="Logout bem-sucedido",
 *         @OA\JsonContent(
 *             @OA\Property(property="response", type="string", example="Usuário desconectado com sucesso."),
 *             @OA\Property(property="response_code", type="integer", example=111)
 *         )
 *     )
 * )
 */

class LogoutResponse
{
}