<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RefreshAuthRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules_response = [
            "token_type" => "required|string|in:Refresh",
        ];

        return $rules_response;
    }
}
