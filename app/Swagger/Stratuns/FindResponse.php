<?php

namespace App\Swagger\Stratuns;

/**
 * @OA\Get(
 *     path="/stratuns",
 *     summary="Obter status das transferências do usuário",
 *     tags={"Operações"},
 *     security={{"bearerAuth": {}}}, 
 *     @OA\Response(
 *         response=200,
 *         description="Lista de transferências pagas pelo usuário",
 *         @OA\JsonContent(
 *             @OA\Property(property="response", type="object",
 *                 @OA\Property(property="paid", type="array",
 *                     @OA\Items(
 *                         @OA\Property(property="value", type="string", example="R$ 1,00"),
 *                         @OA\Property(property="sender", type="string", example="Erick"),
 *                         @OA\Property(property="receiver", type="string", example="Erick"),
 *                         @OA\Property(property="status", type="string", example="Complete")
 *                     )
 *                 )
 *             ),
 *             @OA\Property(property="response_code", type="integer", example=111)
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Erro na requisição",
 *         @OA\JsonContent(
 *             @OA\Property(property="response", type="string", example="Erro ao buscar as transferências."),
 *             @OA\Property(property="response_code", type="integer", example=400)
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Estrato não encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="response", type="string", example="Houve um erro na localização do estrato."),
 *             @OA\Property(property="response_code", type="integer", example=404)
 *         )
 *     )
 * )
 */

class FindResponse
{
}
