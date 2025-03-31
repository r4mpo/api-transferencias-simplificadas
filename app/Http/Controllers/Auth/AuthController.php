<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\DetalharService;
use App\Services\Auth\LogoutService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\DTO\Default\ResponseDTO;
use App\Services\Auth\RegistrarService;
use App\Services\Auth\LoginService;

class AuthController extends Controller
{
    private RegistrarService $registrar_service;
    private LoginService $login_service;
    private DetalharService $detalhar_service;
    private LogoutService $logout_service;

    private ResponseDTO $resposta_dto;

    public function __construct(RegistrarService $registrar_service, LoginService $login_service, DetalharService $detalhar_service, LogoutService $logout_service)
    {
        parent::__construct();
        $this->resposta_dto = new ResponseDTO();
        $this->login_service = $login_service;
        $this->logout_service = $logout_service;
        $this->detalhar_service = $detalhar_service;
        $this->registrar_service = $registrar_service;
    }

    public function registrar(Request $requisicao): JsonResponse
    {
        $this->resposta_dto = $this->registrar_service->registrar($requisicao->all());
        return $this->resposta($this->resposta_dto);
    }

    public function login(Request $requisicao): JsonResponse
    {
        $this->resposta_dto = $this->login_service->login($requisicao->all());
        return $this->resposta($this->resposta_dto);
    }

    public function detalhar(): JsonResponse
    {
        $this->resposta_dto = $this->detalhar_service->detalhar();
        return $this->resposta(resposta_dto: $this->resposta_dto);
    }

    public function logout(): JsonResponse
    {
        $this->resposta_dto = $this->logout_service->logout();
        return $this->resposta(resposta_dto: $this->resposta_dto);
    }
}