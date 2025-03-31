<?php

namespace App\DTO\Default;

abstract class RequestDTO
{
    public function retorno_padrao_dto($chaves_nao_esperadas)
    {
        foreach ($chaves_nao_esperadas as $chave) {
            $resposta[] = "Chave " . $chave . " não pode ser utilizada.";
        }

        if (!empty($chaves_nao_esperadas)) {
            throw new \InvalidArgumentException(implode(',', $resposta));
        }
    }
}