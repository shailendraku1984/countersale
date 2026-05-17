<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | User
            |--------------------------------------------------------------------------
            */

            'name' => 'required|string|max:255',

            'phone' => 'nullable|string|max:20',

            /*
            |--------------------------------------------------------------------------
            | Addresses
            |--------------------------------------------------------------------------
            */

            'addresses' => 'required|array',

            'addresses.*.type' => [
                'required',
                Rule::in(['shipping', 'billing']),
            ],

            'addresses.*.full_name' => 'required|string|max:255',

            'addresses.*.phone' => 'nullable|string|max:20',

            'addresses.*.country' => 'nullable|string|max:100',

            'addresses.*.state' => 'nullable|string|max:100',

            'addresses.*.city' => 'nullable|string|max:100',

            'addresses.*.zip_code' => 'nullable|string|max:20',

            'addresses.*.landmark' => 'nullable|string|max:255',

            'addresses.*.address_line_1' => 'required|string|max:500',

            'addresses.*.address_line_2' => 'nullable|string|max:500',

            'addresses.*.is_default' => 'nullable|boolean',
        ];
    }
}