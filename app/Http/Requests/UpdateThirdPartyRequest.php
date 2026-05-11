<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateThirdPartyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'third_party_name' => ['required', 'max:255'],
            'third_party_type' => ['required', 'exists:vendor_type,id'],
            'branch_name' => ['nullable', 'max:255'],
            'vendor' => ['required', 'in:yes,no'],
            'status' => ['required', 'in:open,close'],
            'country' => ['required', 'exists:countries,id'],
            'state' => ['required', 'exists:states,id'],
            'city' => ['required', 'exists:cities,id'],
            'baecode' => ['nullable', 'max:255'],
            'address' => ['nullable'],
            'zipcode' => ['nullable', 'max:50'],
            'phone' => ['nullable', 'max:50'],
            'web_url' => ['nullable', 'url', 'max:255'],
            'sales_tax' => ['required', 'in:yes,no'],
            'vat_id' => ['nullable', 'max:255'],
            'third_party_is' => ['required', 'exists:third_party_is,id'],
            'work_force' => ['required', 'exists:workforce,id'],
            'business_entity_type' => ['required', 'exists:business_entity,id'],
            'capital' => ['nullable', 'numeric', 'min:0'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }
}
