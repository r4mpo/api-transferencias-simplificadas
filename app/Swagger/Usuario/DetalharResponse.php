<?php

namespace App\Swagger\Usuario;

/**
 * @OA\Get(
 *     path="/usuario/detalhar",
 *     summary="Obter detalhar do usuário autenticado",
 *     tags={"Autenticação"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Response(
 *         response=111,
 *         description="detalhar do usuário",
 *         @OA\JsonContent(
 *             @OA\Property(property="resposta", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="João"),
 *                 @OA\Property(property="email", type="string", example="joao@email.com"),
 *                 @OA\Property(property="email_verified_at", type="string", format="date-time", example="2025-03-04T16:33:44.000000Z"),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-03-04T16:33:44.000000Z"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-03-04T16:33:44.000000Z")
 *             ),
 *             @OA\Property(property="codigo_resposta", type="integer", example=111)
 *         )
 *     ),
 *     @OA\Response(
 *         response=333,
 *         description="Credenciais inválidas",
 *         @OA\JsonContent(
 *             @OA\Property(property="resposta", type="string", example="Credenciais e/ou sessões inválidas. Tente novamente."),
 *             @OA\Property(property="codigo_resposta", type="integer", example=333)
 *         )
 *     )
 * )
 */

class DetalharResponse
{
}