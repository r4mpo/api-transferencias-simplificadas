<?php

namespace App\ValueObjects\Auth;

use App\DTO\Auth\RegisterAuthDTO;
use App\Helpers\ValidationMessages;
use App\Http\Requests\Auth\RegisterAuthRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterAuthVO
{
    protected $value;
    private $register_auth_request;
    private $validation_messages;

    public function __construct($request)
    {
        $this->register_auth_request = new RegisterAuthRequest();
        $this->validation_messages = new ValidationMessages();
        $this->value = new RegisterAuthDTO($request);
        $this->validar($request);
    }

    public function value(): RegisterAuthDTO
    {
        return $this->value;
    }

    protected function validar($request): void
    {
        $rules = $this->register_auth_request->rules();
        $validation_messages = $this->validation_messages->mensagens();

        $validacao_rules = Validator::make($request, $rules, $validation_messages);

        if ($validacao_rules->fails()) {
            throw new \Exception(implode(',', $validacao_rules->errors()->all()));
        }
    }
}