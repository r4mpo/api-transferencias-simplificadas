<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\DTO\Default\ResponseDTO;

class LoggingHelper
{
    public static function general_log(Request|array $requestData, ResponseDTO $response): void
    {
        Log::info(
            "Request:",
            [
                'USER' => Auth::id(),
                'METHOD' => request()->method(),
                'REQUEST_PATH' => request()->path(),
                'REQUEST' => [
                    'request' => request()
                ],
                'RESPONSE' => [
                    'response' => $response->get_return(),
                    'response_code' => $response->get_return_code(),
                    'status' => $response->get_status_code()
                ]
            ]
        );
    }
}