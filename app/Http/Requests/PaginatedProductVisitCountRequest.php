<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PaginatedProductVisitCountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'page' => ['nullable', 'int', 'min:1'],
            'per_page' => ['nullable', 'int', 'min:1', 'max:50'],
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

    protected function prepareForValidation(): void
    {
        $this->merge(['marketer_id', Auth::id()]);
    }
}
