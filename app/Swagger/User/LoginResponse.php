<?php

namespace App\Swagger\User;

/**
 * @OA\Post(
 *     path="/user/login",
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
 *         response=201,
 *         description="Login bem-sucedido",
 *         @OA\JsonContent(
 *             @OA\Property(property="response", type="object",
 *                 @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."),
 *                 @OA\Property(property="id_user", type="integer", example=1),
 *                 @OA\Property(property="token_type", type="string", example="bearer"),
 *                 @OA\Property(property="expira_em", type="integer", example=3600)
 *             ),
 *             @OA\Property(property="response_code", type="integer", example=111)
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Credenciais inválidas",
 *         @OA\JsonContent(
 *             @OA\Property(property="response", type="string", example="Credenciais inválidas. Tente novamente."),
 *             @OA\Property(property="response_code", type="integer", example=333)
 *         )
 *     )
 * )
 */

class LoginResponse
{
}