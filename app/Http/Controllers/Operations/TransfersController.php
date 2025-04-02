<?php

namespace App\Http\Controllers\Operations;

use App\DTO\Default\ResponseDTO;
use App\Http\Controllers\Controller;
use App\Services\Operations\Transfers\SendService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransfersController extends Controller
{
    private SendService $send_service;

    private ResponseDTO $response_dto;

    public function __construct(SendService $send_service)
    {
        parent::__construct();
        $this->response_dto = new ResponseDTO();
        $this->send_service = $send_service;
    }

    public function send(Request $request): JsonResponse
    {
        $this->response_dto = $this->send_service->send($request->all());
        return $this->response($this->response_dto);
    }
}