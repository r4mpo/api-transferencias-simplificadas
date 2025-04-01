<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterAuthRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules_response = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'individual_registration' => 'nullable|individual_registration|max:11|unique:users|required_without:legal_entity_number_registration',
            'legal_entity_number_registration' => 'nullable|legal_entity_number_registration|max:14|unique:users|required_without:individual_registration',
            'password' => 'required|string|min:6',
        ];

        return $rules_response;
    }
}