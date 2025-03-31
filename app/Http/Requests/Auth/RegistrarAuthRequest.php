<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegistrarAuthRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $regras_resposta = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'cpf' => 'nullable|cpf|max:11|unique:users|required_without:cnpj',
            'cnpj' => 'nullable|cnpj|max:14|unique:users|required_without:cpf',
            'password' => 'required|string|min:6',
        ];

        return $regras_resposta;
    }
}