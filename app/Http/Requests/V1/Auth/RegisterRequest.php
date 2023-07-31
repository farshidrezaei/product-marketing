<?php

namespace App\Http\Requests\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users', 'max:254'],
            'password' => [
                'required',
                'confirmed',
                Password::min(6)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
