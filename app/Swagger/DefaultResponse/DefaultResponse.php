<?php

namespace App\Swagger\DefaultResponse;

/**
 * @OA\Options(
 *      path="default",
 *      operationId="deaultResponse",
 *      tags={"Retorno Padrão"},
 *      summary="Retornos padronizados",
 *      description="Retornos padronizados independente do endpoint.",
 *      @OA\Response(
 *          response=401,
 *          description="401 - Token Inválido",
 *          @OA\JsonContent(
 *              @OA\Property(property="response", type="string", example="Token invalido."),
 *              @OA\Property(property="responseCod", type="integer", example=333)
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=404,
 *          description="404 - Rota Não Encontrada",
 *          @OA\JsonContent(
 *              @OA\Property(property="response", type="string", example="Rota não encontrada."),
 *              @OA\Property(property="responseCod", type="integer", example=333)
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=405,
 *          description="405 - Método Não Permitido",
 *          @OA\JsonContent(
 *              @OA\Property(property="response", type="string", example="Método não permitido para esta rota."),
 *              @OA\Property(property="responseCod", type="integer", example=333)
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=500,
 *          description="500 - Erro Interno do Servidor",
 *          @OA\JsonContent(
 *              @OA\Property(property="response", type="string", example="Erro desconhecido."),
 *              @OA\Property(property="responseCod", type="integer", example=333)
 *          )
 *      )
 * )
 */

class DefaultResponse{}
