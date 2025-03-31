<?php

namespace App\Swagger\Usuario;

/**
 * @OA\Post(
 *     path="/usuario/login",
 *     summary="Autenticar usuário e obter token",
 *     tags={"Autenticação"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"email", "password"},
 *             @OA\Property(property="email", type="string", format="email", example="joao@email.com"),
 *             @OA\Property(property="password", type="string", format="password", example="123456")
 *         )
 *     ),
 *     @OA\Response(
 *         response=111,
 *         description="Login bem-sucedido",
 *         @OA\JsonContent(
 *             @OA\Property(property="resposta", type="object",
 *                 @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."),
 *                 @OA\Property(property="id_usuario", type="integer", example=1),
 *                 @OA\Property(property="tipo_token", type="string", example="bearer"),
 *                 @OA\Property(property="expira_em", type="integer", example=3600)
 *             ),
 *             @OA\Property(property="codigo_resposta", type="integer", example=111)
 *         )
 *     ),
 *     @OA\Response(
 *         response=333,
 *         description="Credenciais inválidas",
 *         @OA\JsonContent(
 *             @OA\Property(property="resposta", type="string", example="Credenciais inválidas. Tente novamente."),
 *             @OA\Property(property="codigo_resposta", type="integer", example=333)
 *         )
 *     )
 * )
 */

class LoginResponse
{
}