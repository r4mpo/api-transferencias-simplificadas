<?php

namespace App\Swagger;

/**
 * @OA\Info(
 *     title="API Laravel - Base Perfeita",
 *     version="1.0.0"
 * )
 *
 * @OA\Server(
 *     url="http://127.0.0.1:8000/api/"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 *
 * @OA\Parameter(
 *     name="Accept",
 *     in="header",
 *     required=true,
 *     @OA\Schema(type="string", default="application/json")
 * )
 */

class ConfigSwagger
{
    //
}
