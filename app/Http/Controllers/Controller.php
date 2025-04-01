<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    public function __construct()
    {
        //
    }

    protected function response($response_dto): JsonResponse
    {
        return response()->json(
            $response_dto->to_array(),
            $response_dto->get_status_code()
        );
    }
}