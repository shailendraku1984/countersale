<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'label' => ['required', 'max:255'],
            'value_date' => ['required', 'date'],
            'head' => ['required', 'integer', 'exists:head_head,id'],
            'department' => ['required', 'integer', 'exists:department,id'],
            'description' => ['nullable'],
            'bank_account' => ['required', 'integer', 'exists:bank_cash,id'],
            'account' => ['nullable', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }
}
