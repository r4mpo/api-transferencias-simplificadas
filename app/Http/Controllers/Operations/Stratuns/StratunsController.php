<?php

namespace App\Http\Controllers\Operations\Stratuns;

use App\DTO\Default\ResponseDTO;
use App\Http\Controllers\Controller;
use App\Services\Operations\Stratuns\FindService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StratunsController extends Controller
{
    private FindService $find_service;

    private ResponseDTO $response_dto;

    public function __construct(FindService $find_service)
    {
        parent::__construct();
        $this->response_dto = new ResponseDTO();
        $this->find_service = $find_service;
    }

    public function find(): JsonResponse
    {
        $this->response_dto = $this->find_service->find();
        return $this->response($this->response_dto);
    }
}