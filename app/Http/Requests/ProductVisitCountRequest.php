<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductVisitCountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'filters.marketer_id' => ['required', 'int', 'exists:users,id'],
            'filters.range' => ['required', 'array'],
            'filters.range.from' => ['nullable', 'date', 'date_format:Y/m/d H:i:s', 'before_or_equal:range.to'],
            'filters.range.to' => ['nullable', 'date', 'date_format:Y/m/d H:i:s', 'after_or_equal:range.from']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
