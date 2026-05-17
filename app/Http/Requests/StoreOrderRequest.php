<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | Addresses
            |--------------------------------------------------------------------------
            */

            'shipping_address_id' => 'required|exists:user_addresses,id',

            'billing_address_id' => 'nullable|exists:user_addresses,id',

            /*
            |--------------------------------------------------------------------------
            | Payment
            |--------------------------------------------------------------------------
            */

            'payment_method' => [
				'required',
				Rule::in([
					'cod',
					'razorpay',
					'stripe',
					'paypal',
					'upi'
				])
			],

            /*
            |--------------------------------------------------------------------------
            | Notes
            |--------------------------------------------------------------------------
            */

            'notes' => 'nullable|string|max:1000',
        ];
    }
}