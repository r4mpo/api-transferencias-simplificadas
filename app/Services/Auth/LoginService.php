<?php

namespace App\Services\Auth;

use App\DTO\Default\ResponseDTO;
use App\Services\DefaultService;
use App\ValueObjects\Auth\LoginAuthVO;

class LoginService extends DefaultService
{
    protected string $not_found_message = 'Credenciais e/ou sessões inválidas. Tente novamente.';

    public function __construct()
    {
        parent::__construct();
    }

    public function login($request): ResponseDTO
    {
        try {
            new LoginAuthVO($request);
            $response_db = $this->validate_credential_tokens($request);
            $response = $this->standardize_response($response_db, $response_db, $this->not_found_message);
            $this->set_response_data($response);
        } catch (\Exception $e) {
            $this->handle_exception($e);
        } finally {
            return $this->response_data($request);
        }
    }

    private function validate_credential_tokens($credenciais): array|bool
    {
        if (!$token = auth()->attempt($credenciais)) {
            return false;
        }

        return $this->generate_token($token);
    }

    private function generate_token($token): array
    {
        return [
            'token' => $token,
            'id_user' => auth()->id(),
            'token_type' => 'bearer',
            'expira_em' => auth()->factory()->getTTL() * 60
        ];
    }
}