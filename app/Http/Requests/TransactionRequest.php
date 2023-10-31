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
            'product_id' => ['required'],
            'duitku_order_id' => ['required'],
            'total_item' => ['required'],
            'total_price' => ['required'],
            'customer_info' => ['nullable','string'],
            'payment_method' => ['required'],
            'payment_url' => ['nullable','string'],
            'transaction_created' => ['required'],
            'transaction_finished' => ['nullable'],
        ];
    }
}
