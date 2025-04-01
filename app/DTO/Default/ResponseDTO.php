<?php

namespace App\DTO\Default;

class ResponseDTO
{
    protected $status_code;
    protected $message;
    public $return_code;

    public function __construct(int $status_code = 500, $message = 'Erro desconhecido', int $return_code = 333)
    {
        $this->set_status_code($status_code);
        $this->set_return_code($return_code);
        $this->set_return($message);
    }

    public function get_status_code(): int
    {
        return $this->status_code;
    }

    public function get_return()
    {
        return $this->message;
    }

    public function get_return_code(): int
    {
        return $this->return_code;
    }

    public function set_status_code(int $status_code): void
    {
        $this->status_code = $status_code;
    }

    public function set_return($message): void
    {
        $this->message = $message;
    }

    public function set_return_code(int $return_code): void
    {
        $this->return_code = $return_code;
    }

    public function to_array(): array
    {
        return [
            'response' => $this->get_return(),
            'response_code' => $this->get_return_code()
        ];
    }
}