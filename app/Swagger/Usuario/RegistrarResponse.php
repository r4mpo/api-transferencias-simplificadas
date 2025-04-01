<?php

namespace App\Swagger\Usuario;

/**
 * @OA\Post(
 *     path="/user/register",
 *     summary="Register um novo usuário",
 *     tags={"Autenticação"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "email", "password"},
 *             @OA\Property(property="name", type="string", example="João"),
 *             @OA\Property(property="email", type="string", format="email", example="joao@email.com"),
 *             @OA\Property(property="password", type="string", format="password", example="123456"),
 *             @OA\Property(property="individual_registration", type="string", nullable=true, example="12345678901"),
 *             @OA\Property(property="legal_entity_number_registration", type="string", nullable=true, example="12345678000195")
 *         )
 *     ),
 *     @OA\Response(
 *         response=111,
 *         description="Usuário cadastrado com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(property="response", type="object",
 *                 @OA\Property(property="user", type="object",
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="name", type="string", example="João"),
 *                     @OA\Property(property="email", type="string", example="joao@email.com"),
 *                     @OA\Property(property="email_verified_at", type="string", format="date-time", example="2025-03-04T16:33:44.000000Z"),
 *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-03-04T16:33:44.000000Z"),
 *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-03-04T16:33:44.000000Z"),
 *                     @OA\Property(property="individual_registration", type="string", nullable=true, example="12345678901"),
 *                     @OA\Property(property="legal_entity_number_registration", type="string", nullable=true, example="12345678000195")
 *                 ),
 *                 @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...")
 *             ),
 *             @OA\Property(property="response_code", type="integer", example=111)
 *         )
 *     ),
 *     @OA\Response(
 *         response=333,
 *         description="Erro ao register usuário",
 *         @OA\JsonContent(
 *             @OA\Property(property="response", type="string", example="Erro desconhecido"),
 *             @OA\Property(property="response_code", type="integer", example=333)
 *         )
 *     )
 * )
 */

class RegisterResponse
{
}