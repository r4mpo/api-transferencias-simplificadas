<?php

namespace App\DTO\Auth;

use App\DTO\Default\RequestDTO;

class RegisterAuthDTO extends RequestDTO
{
    public function __construct($data)
    {
        $expected_keys = [
            'name',
            'email',
            'individual_registration', // cpf
            'legal_entity_number_registration', // cnpj
            'password'
        ];

        $unexpected_keys = array_diff(array_keys($data), $expected_keys);
        $this->default_return_dto($unexpected_keys);
    }
}
