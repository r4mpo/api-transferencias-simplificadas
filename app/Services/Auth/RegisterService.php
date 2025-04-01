<?php

namespace App\Services\Auth;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Services\DefaultService;
use App\DTO\Default\ResponseDTO;
use App\Repositories\UsersRepository;
use App\ValueObjects\Auth\RegisterAuthVO;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterService extends DefaultService
{
    protected UsersRepository $users_repository;
    protected string $not_found_message = '';

    public function __construct(UsersRepository $users_repository)
    {
        parent::__construct();
        $this->users_repository = $users_repository;
    }

    public function register($request): ResponseDTO
    {
        try {
            new RegisterAuthVO($request);
            $response_db = $this->preparar_dados_legiveis($request);
            $response = $this->standardize_response($response_db, $response_db, $this->not_found_message);
            $this->set_response_data($response);
        } catch (\Exception $e) {
            $this->handle_exception($e);
        } finally {
            return $this->response_data($request);
        }
    }

    private function preparar_dados_legiveis(array $request): array
    {
        $user = $this->criar_user($request);
        $token = $this->generate_token($user);
        return ['user' => $user, 'token' => $token];
    }

    private function criar_user(array $request): User
    {
        return $this->users_repository->register_db([
            'name' => $request['name'],
            'email' => $request['email'],
            'individual_registration' => $request['individual_registration'] ?? null,
            'legal_entity_number_registration' => $request['legal_entity_number_registration'] ?? null,
            'profile' => empty($request['individual_registration']) ? User::STORE_OWNER_PROFILE : User::USER_PROFILE,
            'password' => $this->codificar_senha($request['password']),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function generate_token(User $user): string
    {
        return JWTAuth::fromUser($user);
    }

    private function codificar_senha($senha)
    {
        return Hash::make($senha);
    }
}