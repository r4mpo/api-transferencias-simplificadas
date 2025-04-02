<?php

namespace App\ValueObjects\Operations\Transfers;

use App\DTO\Operations\Transfers\SendDTO;
use App\Helpers\ValidationMessages;
use App\Http\Requests\Operations\Transfers\SendRequest;
use Illuminate\Support\Facades\Validator;

class SendVO
{
    protected $value;
    private $send_request;
    private $validation_messages;

    public function __construct($request)
    {
        $this->send_request = new SendRequest();
        $this->validation_messages = new ValidationMessages();
        $this->value = new SendDTO($request);
        $this->validate($request);
    }

    public function value(): SendDTO
    {
        return $this->value;
    }

    protected function validate($request): void
    {
        $rules = $this->send_request->rules();
        $validation_messages = $this->validation_messages->mensagens();

        $validacao_rules = Validator::make($request, $rules, $validation_messages);

        if ($validacao_rules->fails()) {
            throw new \Exception(implode(',', $validacao_rules->errors()->all()));
        }
    }
}