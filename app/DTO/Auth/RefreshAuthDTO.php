<?php

namespace App\DTO\Auth;

use App\DTO\Default\RequestDTO;

class RefreshAuthDTO extends RequestDTO
{
    public function __construct($data)
    {
        $expected_keys = [];
        $unexpected_keys = array_diff(array_keys($data), $expected_keys);
        $this->default_return_dto($unexpected_keys);
    }
}