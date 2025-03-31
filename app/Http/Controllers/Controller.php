<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    public function __construct()
    {
        //
    }

    protected function resposta($resposta_dto): JsonResponse
    {
        return response()->json(
            $resposta_dto->to_array(),
            $resposta_dto->get_status_code()
        );
    }
}