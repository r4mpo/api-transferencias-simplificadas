<?php

namespace App\ValueObjects\Auth;

use App\DTO\Auth\RecarregarAuthDTO;
use App\Helpers\MensagensValidacao;
use App\Http\Requests\Auth\RecarregarAuthRequest;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class RecarregarAuthVO
{
    protected $valor;
    private $recarregar_auth_request;
    private $mensagens_validacao;

    public function __construct($requisicao)
    {
        $this->recarregar_auth_request = new RecarregarAuthRequest();
        $this->mensagens_validacao = new MensagensValidacao();
        $this->valor = new RecarregarAuthDTO($requisicao);
        $this->validar();
    }

    public function valor()
    {
        return $this->valor;
    }

    protected function validar(): void
    {
        $dados_validacao = ['type_token' => JWTAuth::parseToken()->getPayload()->get('type')];
        $regras = $this->recarregar_auth_request->rules();
        $mensagens_validacao = $this->mensagens_validacao->mensagens();

        $validacao_regras = Validator::make($dados_validacao, $regras, $mensagens_validacao);

        if ($validacao_regras->fails()) {
            throw new \Exception(implode(',', $validacao_regras->errors()->all()));
        }
    }
}