<?php

namespace App\Swagger\User;

/**
 * @OA\Get(
 *     path="/user/show",
 *     summary="Obter show do usuário autenticado",
 *     tags={"Autenticação"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Response(
 *         response=200,
 *         description="show do usuário",
 *         @OA\JsonContent(
 *             @OA\Property(property="response", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="João"),
 *                 @OA\Property(property="email", type="string", example="joao@email.com"),
 *                 @OA\Property(property="email_verified_at", type="string", format="date-time", example="2025-03-04T16:33:44.000000Z"),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-03-04T16:33:44.000000Z"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-03-04T16:33:44.000000Z")
 *             ),
 *             @OA\Property(property="response_code", type="integer", example=111)
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Credenciais inválidas",
 *         @OA\JsonContent(
 *             @OA\Property(property="response", type="string", example="Credenciais e/ou sessões inválidas. Tente novamente."),
 *             @OA\Property(property="response_code", type="integer", example=333)
 *         )
 *     )
 * )
 */

class ShowResponse
{
}