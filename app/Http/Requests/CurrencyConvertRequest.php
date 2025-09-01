<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyConvertRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // или добавить логику авторизации
    }

    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:0.01',
            'from'   => 'required|string|size:3',
            'to'     => 'required|string|size:3',
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required' => 'Сумма обязательна для ввода',
            'amount.numeric'  => 'Сумма должна быть числом',
            'amount.min'      => 'Сумма должна быть больше нуля',
            'from.size'       => 'Код валюты FROM должен состоять из 3 букв (например, USD)',
            'to.size'         => 'Код валюты TO должен состоять из 3 букв (например, EUR)',
        ];
    }
}
