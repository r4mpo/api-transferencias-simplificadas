<?php

namespace App\Helpers;

class ValidationMessages
{
    public function mensagens(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'numeric' => ':attribute deve ser numérico.',
            'unique' => 'O valor :attribute já está inserido!',
            'string' => 'O campo :attribute deve ser uma string.',
            'digits' => 'O campo :attribute deve ter :digits dígitos.',
            'email' => 'O campo :attribute deve ser um endereço de e-mail válido.',
            'regex' => 'O formato do campo :attribute é inválido.',
            'min' => 'O campo :attribute deve ter pelo menos :min caracteres.',
            'max' => 'O campo :attribute não pode ter mais de :max caracteres.',
            'date' => 'O campo :attribute deve ser uma data válida.',
            'date_format' => 'O campo :attribute deve estar no formato Y-m-d H:i:s.',
            'data_sincronizacao.date_format' => 'O campo :attribute deve estar no formato Y-m-dTH:i:sZ.',
            'after' => 'O campo :attribute deve ser uma data posterior a :date.',
            'before' => 'O campo :attribute deve ser uma data anterior a :date.',
            'exists' => 'O valor do campo :attribute selecionado é inválido.',
            'in' => 'O valor selecionado para :attribute é inválido.',
            'array' => 'O campo :attribute deve ser um Array.',
            'size' => 'O campo :attribute deve ter exatamente :size elemento(s).',
            'gt' => 'O campo :attribute deve ser maior que :value.',
            'boolean' => 'O campo :attribute deve ser do type boolean.',
            'json' => 'O campo :attribute deve ser um JSON válido.',
            'mimes' => 'O campo :attribute deve conter um arquivo de formato válido.',
            'integer' => 'O campo :attribute deve ser do formato inteiro.',
            'after_or_equal' => 'O campo :attribute deve ser uma data posterior ou igual a :date.',
            'individual_registration' => 'O campo :attribute deve ser um Cadastro Pessoa Física válido.',
            'legal_entity_number_registration' => 'O campo :attribute deve ser um Cadastro Número Pessoa Jurídica válido.',
            'different' => 'O campo :attribute deve ser diferente de :other.'
        ];
    }
}