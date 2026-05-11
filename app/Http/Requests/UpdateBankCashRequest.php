<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBankCashRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $bankCashId = $this->route('bankCash')?->id;

        return [
            'ref' => [
                'required',
                'max:255',
                Rule::unique('bank_cash', 'ref')->ignore($bankCashId),
            ],
            'bank_or_cash_label' => [
                'required',
                'max:255',
            ],
            'account_type' => [
                'required',
                'exists:bank_account_type,id',
            ],
            'currency' => [
                'required',
                'exists:currency,id',
            ],
            'status' => [
                'required',
                'in:open,close',
            ],
            'country' => [
                'required',
                'exists:countries,id',
            ],
            'state' => [
                'required',
                'exists:states,id',
            ],
            'city' => [
                'required',
                'exists:cities,id',
            ],
            'minimum_allowed_balance' => [
                'nullable',
                'numeric',
            ],
            'minimum_desired_balance' => [
                'nullable',
                'numeric',
            ],
            'bank_name' => [
                'nullable',
                'max:255',
            ],
            'account_number' => [
                'nullable',
                'max:255',
            ],
            'IBAN_account_number' => [
                'nullable',
                'max:255',
            ],
            'SWIFT_code' => [
                'nullable',
                'max:255',
            ],
            'bank_address' => [
                'nullable',
            ],
            'account_owner_name' => [
                'nullable',
                'max:255',
            ],
            'account_owner_address' => [
                'nullable',
            ],
            'accounting_account' => [
                'nullable',
                'max:255',
            ],
        ];
    }
}
