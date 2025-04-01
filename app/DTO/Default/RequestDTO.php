<?php

namespace App\DTO\Default;

abstract class RequestDTO
{
    public function default_return_dto($unexpected_keys)
    {
        foreach ($unexpected_keys as $key) {
            $response[] = "Chave " . $key . " não pode ser utilizada.";
        }

        if (!empty($unexpected_keys)) {
            throw new \InvalidArgumentException(implode(',', $response));
        }
    }
}