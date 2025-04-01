<?php

namespace App\Services\Auth;

use App\DTO\Default\ResponseDTO;
use App\Services\DefaultService;

class ShowService extends DefaultService
{
    protected string $not_found_message = 'Credenciais e/ou sessões inválidas. Tente novamente.';

    public function __construct()
    {
        parent::__construct();
    }
    
    public function show(): ResponseDTO
    {
        try {
            $response_db = auth()->user();
            $response = $this->standardize_response($response_db, $response_db, $this->not_found_message);
            $this->set_response_data($response);
        } catch (\Exception $e) {
            $this->handle_exception($e);
        } finally {
            return $this->response_data([]);
        }
    }
}