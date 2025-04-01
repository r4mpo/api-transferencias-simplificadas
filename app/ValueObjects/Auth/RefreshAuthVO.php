<?php

namespace App\ValueObjects\Auth;

use App\DTO\Auth\RefreshAuthDTO;
use App\Helpers\ValidationMessages;
use App\Http\Requests\Auth\RefreshAuthRequest;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class RefreshAuthVO
{
    protected $value;
    private $refresh_auth_request;
    private $validation_messages;

    public function __construct($request)
    {
        $this->refresh_auth_request = new RefreshAuthRequest();
        $this->validation_messages = new ValidationMessages();
        $this->value = new RefreshAuthDTO($request);
        $this->validar();
    }

    public function value()
    {
        return $this->value;
    }

    protected function validar(): void
    {
        $data_validacao = ['token_type' => JWTAuth::parseToken()->getPayload()->get('type')];
        $rules = $this->refresh_auth_request->rules();
        $validation_messages = $this->validation_messages->mensagens();

        $validacao_rules = Validator::make($data_validacao, $rules, $validation_messages);

        if ($validacao_rules->fails()) {
            throw new \Exception(implode(',', $validacao_rules->errors()->all()));
        }
    }
}