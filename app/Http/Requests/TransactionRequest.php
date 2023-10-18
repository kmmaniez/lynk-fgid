<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required'],
            'total_item' => ['required','integer'],
            'customer_email' => ['required','email'],
            'payment_options' => ['required','string'],
            'payment_status' => ['required'],
            'date_transaction' => ['required','date'],
        ];
    }
}
