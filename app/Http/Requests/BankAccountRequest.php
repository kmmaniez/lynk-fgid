<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankAccountRequest extends FormRequest
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
            'bank_name' => ['required','string'],
            'bank_number' => ['required','numeric'],
            'bank_account_name' => ['required','regex:/^[a-zA-Z ]*$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'bank_name' => 'Bank/E-wallet is required',
            'bank_number' => [
                'required' => 'Bank number is required',
                'numeric' => 'Bank number must be number',
            ],
            'bank_account_name' => [
                'required' => 'Account bank is required',
                'numeric' => 'Account bank must be alphabet (numeric/symbol not allowed)',
            ]
        ];
    }
}
