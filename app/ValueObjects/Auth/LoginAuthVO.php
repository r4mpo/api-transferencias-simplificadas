<?php

namespace App\ValueObjects\Auth;

use App\DTO\Auth\LoginAuthDTO;
use App\Helpers\ValidationMessages;
use App\Http\Requests\Auth\LoginAuthRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class LoginAuthVO
{
    protected $value;
    private $login_auth_request;
    private $validation_messages;

    public function __construct($request)
    {
        $this->login_auth_request = new LoginAuthRequest();
        $this->validation_messages = new ValidationMessages();
        $this->value = new LoginAuthDTO($request);
        $this->validate($request);
    }

    public function value(): LoginAuthDTO
    {
        return $this->value;
    }

    protected function validate($request): void
    {
        $rules = $this->login_auth_request->rules();
        $validation_messages = $this->validation_messages->mensagens();

        $validacao_rules = Validator::make($request, $rules, $validation_messages);

        if ($validacao_rules->fails()) {
            throw new \Exception(implode(',', $validacao_rules->errors()->all()));
        }
    }
}