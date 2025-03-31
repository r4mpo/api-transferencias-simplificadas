<?php

namespace App\Services\Auth;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Services\DefaultService;
use App\DTO\Default\ResponseDTO;
use App\Repositories\UsersRepository;
use App\ValueObjects\Auth\RegistrarAuthVO;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegistrarService extends DefaultService
{
    protected UsersRepository $users_repository;
    protected string $mensagem_nao_encontrada = '';

    public function __construct(UsersRepository $users_repository)
    {
        parent::__construct();
        $this->users_repository = $users_repository;
    }

    public function registrar($requisicao): ResponseDTO
    {
        try {
            new RegistrarAuthVO($requisicao);
            $resposta_db = $this->preparar_dados_legiveis($requisicao);
            $resposta = $this->montar_resposta($resposta_db, $resposta_db, $this->mensagem_nao_encontrada);
            $this->definir_dados_resposta($resposta);
        } catch (\Exception $e) {
            $this->lidar_com_excecao($e);
        } finally {
            return $this->dados_resposta($requisicao);
        }
    }

    private function preparar_dados_legiveis(array $requisicao): array
    {
        $usuario = $this->criar_usuario($requisicao);
        $token = $this->gerar_token($usuario);
        return ['usuario' => $usuario, 'token' => $token];
    }

    private function criar_usuario(array $requisicao): User
    {
        return $this->users_repository->registrar_db([
            'name' => $requisicao['name'],
            'email' => $requisicao['email'],
            'cpf' => $requisicao['cpf'] ?? null,
            'cnpj' => $requisicao['cnpj'] ?? null,
            'password' => $this->codificar_senha($requisicao['password']),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function gerar_token(User $usuario): string
    {
        return JWTAuth::fromUser($usuario);
    }

    private function codificar_senha($senha)
    {
        return Hash::make($senha);
    }
}