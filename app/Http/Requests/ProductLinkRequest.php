<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductLinkRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'slug' => [
                'required',
                Rule::unique('product_links')->ignore($this->route('link')),
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
