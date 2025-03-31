<?php

namespace App\DTO\Default;

class ResponseDTO
{
    protected $status_code;
    protected $mensagem;
    public $codigo_retorno;

    public function __construct(int $status_code = 500, $mensagem = 'Erro desconhecido', int $codigo_retorno = 333)
    {
        $this->set_status_code($status_code);
        $this->set_retorno($mensagem);
        $this->set_codigo_retorno($codigo_retorno);
    }

    public function get_status_code(): int
    {
        return $this->status_code;
    }

    public function get_retorno()
    {
        return $this->mensagem;
    }

    public function get_codigo_retorno(): int
    {
        return $this->codigo_retorno;
    }

    public function set_status_code(int $status_code): void
    {
        $this->status_code = $status_code;
    }

    public function set_retorno($mensagem): void
    {
        $this->mensagem = $mensagem;
    }

    public function set_codigo_retorno(int $codigo_retorno): void
    {
        $this->codigo_retorno = $codigo_retorno;
    }

    public function to_array(): array
    {
        return [
            'resposta' => $this->get_retorno(),
            'codigo_resposta' => $this->get_codigo_retorno()
        ];
    }
}