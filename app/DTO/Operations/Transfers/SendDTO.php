<?php

namespace App\DTO\Operations\Transfers;

use App\DTO\Default\RequestDTO;

class SendDTO extends RequestDTO
{
    public function __construct($data)
    {
        $expected_keys = [
            'sender_id',
            'receiver_id',
            'value',
        ];
        
        $unexpected_keys = array_diff(array_keys($data), $expected_keys);
        $this->default_return_dto($unexpected_keys);
    }
}