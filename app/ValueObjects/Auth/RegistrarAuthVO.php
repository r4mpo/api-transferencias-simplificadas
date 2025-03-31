<?php

namespace App\ValueObjects\Auth;

use App\DTO\Auth\RegistrarAuthDTO;
use App\Helpers\MensagensValidacao;
use App\Http\Requests\Auth\RegistrarAuthRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegistrarAuthVO
{
    protected $valor;
    private $registrar_auth_request;
    private $mensagens_validacao;

    public function __construct($requisicao)
    {
        $this->registrar_auth_request = new RegistrarAuthRequest();
        $this->mensagens_validacao = new MensagensValidacao();
        $this->valor = new RegistrarAuthDTO($requisicao);
        $this->validar($requisicao);
    }

    public function valor(): RegistrarAuthDTO
    {
        return $this->valor;
    }

    protected function validar($requisicao): void
    {
        $regras = $this->registrar_auth_request->rules();
        $mensagens_validacao = $this->mensagens_validacao->mensagens();

        $validacao_regras = Validator::make($requisicao, $regras, $mensagens_validacao);

        if ($validacao_regras->fails()) {
            throw new \Exception(implode(',', $validacao_regras->errors()->all()));
        }
    }
}