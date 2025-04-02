<?php

namespace App\Http\Requests\Operations\Transfers;

use Illuminate\Foundation\Http\FormRequest;

class SendRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules_response = [
            'sender_id' => 'required|exists:users,id|different:receiver_id',
            'receiver_id' => 'required|exists:users,id',
            'value' => 'required|integer|min:1',
        ];

        return $rules_response;
    }
}