<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:100'],
            'username' => ['string', 'alpha_num', 'max:10', Rule::unique(User::class)->ignore($this->user()->id)],
            'email' => ['email', 'max:50', Rule::unique(User::class)->ignore($this->user()->id)],
            'phone' => ['numeric'],
            'coverimage' => ['image','mimes:png,jpg,jpeg', 'max:2048'],
            'photo' => ['image','mimes:png,jpg,jpeg', 'max:2048'],
            'description' => ['string','nullable'],
            'account_type' => ['string'],
            'theme' => ['string'],
        ];
    }
}
