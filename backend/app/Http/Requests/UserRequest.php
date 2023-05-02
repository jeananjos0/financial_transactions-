<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'role_id' => 'required',
            'fullname' => 'required',
            'cpf_cnpj' => 'required|unique:users,cpf_cnpj,' . $this->id,
            'email' => 'required|email|unique:users,email,' . $this->id,
            'password' => 'required',
            'wallet_balance' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'role_id.required' => 'Campo "Permissão" obrigatório',
            'fullname.required' => 'Campo "Nome completo" obrigatório',

            'cpf_cnpj.required' => 'Campo "CPF/CNPJ" obrigatório',
            'cpf_cnpj.unique' => 'O CPF/CNPJ informado já foi cadastrado.',

            'email.required' => 'Campo e-mail obrigatório',
            'email.unique' => 'O e-mail informado já foi cadastrado.',

            'password.required' => 'Campo "senha" obrigatório',
            'wallet_balance.required' => 'Campo "saldo da carteira" obrigatório',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
