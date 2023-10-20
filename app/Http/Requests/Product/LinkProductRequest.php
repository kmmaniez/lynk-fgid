<?php

namespace App\Http\Requests\Product;

use App\Enums\LayoutEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class LinkProductRequest extends FormRequest
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
            'name' => ['required','string'],
            'thumbnail' => ['nullable','image','mimes:png,jpg,jpeg','max:2048'],
            'url' => ['required','url'],
            'layout' => ['required', new Enum(LayoutEnum::class)],
        ];
    }
}
