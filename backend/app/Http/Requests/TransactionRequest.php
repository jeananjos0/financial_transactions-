<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class TransactionRequest extends FormRequest
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
    public function rules()
    {
        return [
            'sender_id' => 'required|exists:users,id|different:recipient_id',
            'recipient_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
        ];
    }

    public function messages()
    {
        return [
            'sender_id.required' => 'O remetente é obrigatório.',
            'sender_id.exists' => 'O remetente não existe.',
            'sender_id.different' => 'O remetente e o destinatário devem ser diferentes.',
            'recipient_id.required' => 'O destinatário é obrigatório.',
            'recipient_id.exists' => 'O destinatário não existe.',
            'amount.required' => 'O valor da transferência é obrigatório.',
            'amount.numeric' => 'O valor da transferência deve ser um número.',
            'amount.min' => 'O valor da transferência deve ser no mínimo 0,01.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

}
