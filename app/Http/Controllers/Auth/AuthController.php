<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\ShowService;
use App\Services\Auth\LogoutService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\DTO\Default\ResponseDTO;
use App\Services\Auth\RegisterService;
use App\Services\Auth\LoginService;

class AuthController extends Controller
{
    private RegisterService $register_service;
    private LoginService $login_service;
    private ShowService $show_service;
    private LogoutService $logout_service;

    private ResponseDTO $response_dto;

    public function __construct(RegisterService $register_service, LoginService $login_service, ShowService $show_service, LogoutService $logout_service)
    {
        parent::__construct();
        $this->response_dto = new ResponseDTO();
        $this->login_service = $login_service;
        $this->logout_service = $logout_service;
        $this->show_service = $show_service;
        $this->register_service = $register_service;
    }

    public function register(Request $request): JsonResponse
    {
        $this->response_dto = $this->register_service->register($request->all());
        return $this->response($this->response_dto);
    }

    public function login(Request $request): JsonResponse
    {
        $this->response_dto = $this->login_service->login($request->all());
        return $this->response($this->response_dto);
    }

    public function show(): JsonResponse
    {
        $this->response_dto = $this->show_service->show();
        return $this->response(response_dto: $this->response_dto);
    }

    public function logout(): JsonResponse
    {
        $this->response_dto = $this->logout_service->logout();
        return $this->response(response_dto: $this->response_dto);
    }
}