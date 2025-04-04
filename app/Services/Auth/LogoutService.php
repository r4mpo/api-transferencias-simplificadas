<?php

namespace App\Services\Auth;

use App\DTO\Default\ResponseDTO;
use App\Services\DefaultService;

class LogoutService extends DefaultService
{
    protected string $not_found_message = 'Erro ao desconectar usuário. Tente novamente.';

    public function __construct()
    {
        parent::__construct();
    }

    public function logout(): ResponseDTO
    {
        try {
            auth()->logout();
            $response_db = true;
            $response = $this->standardize_response($response_db, 'Usuário desconectado com sucesso.', $this->not_found_message);
            $this->set_response_data($response);
        } catch (\Exception $e) {
            $this->handle_exception($e);
        } finally {
            return $this->response_data([]);
        }
    }
}