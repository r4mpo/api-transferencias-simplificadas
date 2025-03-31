<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginAuthRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $regras_resposta = [
            "email" => "required|string",
            "password" => "required|string",
        ];

        return $regras_resposta;
    }
}
