<?php

namespace App\Swagger\Transfers;

/**
 * @OA\Post(
 *     path="/transfer",
 *     summary="Realiza uma transferência entre usuários",
 *     tags={"Transferências"},
 *     security={{"bearerAuth": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"payer", "payee", "value"},
 *             @OA\Property(property="payer", type="integer", example=1, description="ID do usuário que está enviando o valor"),
 *             @OA\Property(property="payee", type="integer", example=2, description="ID do usuário que está recebendo o valor"),
 *             @OA\Property(property="value", type="integer", example=100, description="Valor da transferência em centavos")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Transferência realizada com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(property="response", type="object",
 *                 @OA\Property(property="value", type="string", example="R$ 1,00"),
 *                 @OA\Property(property="sender", type="string", example="Erick"),
 *                 @OA\Property(property="receiver", type="string", example="João")
 *             ),
 *             @OA\Property(property="response_code", type="integer", example=111)
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Erro de validação",
 *         @OA\JsonContent(
 *             @OA\Property(property="response", type="array", @OA\Items(type="string", example="O campo payer é obrigatório.")),
 *             @OA\Property(property="response_code", type="integer", example=333)
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Erro ao processar a transferência",
 *         @OA\JsonContent(
 *             oneOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="response", type="string", example="O serviço externo não autorizou a execução da transferência."),
 *                     @OA\Property(property="response_code", type="integer", example=333)
 *                 ),
 *                 @OA\Schema(
 *                     @OA\Property(property="response", type="string", example="Apenas usuários com o respectivo perfil podem executar transferências."),
 *                     @OA\Property(property="response_code", type="integer", example=333)
 *                 ),
 *                 @OA\Schema(
 *                     @OA\Property(property="response", type="string", example="Saldo insuficiente para realizar a transferência."),
 *                     @OA\Property(property="response_code", type="integer", example=333)
 *                 ),
 *                 @OA\Schema(
 *                     @OA\Property(property="response", type="string", example="Erro ao notificar pagamento, transferência estornada."),
 *                     @OA\Property(property="response_code", type="integer", example=333)
 *                 )
 *             }
 *         )
 *     )
 * )
 */
class SendResponse
{
}
