<?php

namespace App\Swagger\Usuario;

/**
 * @OA\Post(
 *     path="/usuario/registrar",
 *     summary="Registrar um novo usuário",
 *     tags={"Autenticação"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "email", "password"},
 *             @OA\Property(property="name", type="string", example="João"),
 *             @OA\Property(property="email", type="string", format="email", example="joao@email.com"),
 *             @OA\Property(property="password", type="string", format="password", example="123456")
 *         )
 *     ),
 *     @OA\Response(
 *         response=111,
 *         description="Usuário cadastrado com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(property="resposta", type="object",
 *                 @OA\Property(property="usuario", type="object",
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="name", type="string", example="João"),
 *                     @OA\Property(property="email", type="string", example="joao@email.com"),
 *                     @OA\Property(property="email_verified_at", type="string", format="date-time", example="2025-03-04T16:33:44.000000Z"),
 *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-03-04T16:33:44.000000Z"),
 *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-03-04T16:33:44.000000Z")
 *                 ),
 *                 @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...")
 *             ),
 *             @OA\Property(property="codigo_resposta", type="integer", example=111)
 *         )
 *     ),
 *     @OA\Response(
 *         response=333,
 *         description="Erro ao registrar usuário",
 *         @OA\JsonContent(
 *             @OA\Property(property="resposta", type="string", example="Erro desconhecido"),
 *             @OA\Property(property="codigo_resposta", type="integer", example=333)
 *         )
 *     )
 * )
 */

class RegistrarResponse
{
}