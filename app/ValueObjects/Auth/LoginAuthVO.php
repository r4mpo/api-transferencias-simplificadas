<?php

namespace App\ValueObjects\Auth;

use App\DTO\Auth\LoginAuthDTO;
use App\Helpers\MensagensValidacao;
use App\Http\Requests\Auth\LoginAuthRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class LoginAuthVO
{
    protected $valor;
    private $login_auth_request;
    private $mensagens_validacao;

    public function __construct($requisicao)
    {
        $this->login_auth_request = new LoginAuthRequest();
        $this->mensagens_validacao = new MensagensValidacao();
        $this->valor = new LoginAuthDTO($requisicao);
        $this->validar($requisicao);
    }

    public function valor(): LoginAuthDTO
    {
        return $this->valor;
    }

    protected function validar($requisicao): void
    {
        $regras = $this->login_auth_request->rules();
        $mensagens_validacao = $this->mensagens_validacao->mensagens();

        $validacao_regras = Validator::make($requisicao, $regras, $mensagens_validacao);

        if ($validacao_regras->fails()) {
            throw new \Exception(implode(',', $validacao_regras->errors()->all()));
        }
    }
}