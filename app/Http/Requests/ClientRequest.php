<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'cpf' => ['required'],
            'rg' => ['required'],
            'email' => ['required', 'email'],
            'telephone' => ['required'],
            'cep' => ['required'],
            'address' => ['required'],
            'city' => ['required'],
            'neighborhood' => ['required'],
            'state' => ['required'],
            'address_number' => ['required'],
            'avatar' => []
        ];
    }
}
