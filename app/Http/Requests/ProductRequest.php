<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'url' => ['required', 'url'],
            'description' => ['required', 'string', 'max:2048'],
            'pictures' => ['nullable', 'array', 'max:5'],
            'pictures.*' => ['file', 'image', 'max:2048'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
