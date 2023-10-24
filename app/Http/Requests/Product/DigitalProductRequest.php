<?php

namespace App\Http\Requests\Product;

use App\Enums\CtaEnum;
use App\Enums\LayoutEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class DigitalProductRequest extends FormRequest
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
            'name' => ['nullable'],
            'thumbnail' => ['nullable'],
            'images' => ['nullable'],
            'description' => ['nullable'],
            'url' => ['url'],
            'min_price' => ['required','numeric'],
            'max_price' => ['required','numeric','gte:min_price'],
            'messages' => ['nullable'],
            'cta_text' => ['required', new Enum(CtaEnum::class)],
            'layout' => ['required', new Enum(LayoutEnum::class)],
        ];
    }
}
