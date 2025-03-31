<?php

namespace App\DTO\Auth;

use App\DTO\Default\RequestDTO;

class LoginAuthDTO extends RequestDTO
{
    public function __construct($dados)
    {
        $chaves_esperadas = [
            'email',
            'password'
        ];

        $chaves_nao_esperadas = array_diff(array_keys($dados), $chaves_esperadas);

        $this->retorno_padrao_dto($chaves_nao_esperadas);
    }
}