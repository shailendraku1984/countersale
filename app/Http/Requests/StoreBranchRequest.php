<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBranchRequest extends FormRequest {
	
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'branch_name' => [
                'required',
                'max:255',
            ],

            'address' => [
                'required',
            ],

            'zipcode' => [
                'required',
            ],

            'country_id' => [
                'required',
                'exists:countries,id',
            ],

            'state_id' => [
                'required',
                'exists:states,id',
            ],

            'city_id' => [
                'required',
                'exists:cities,id',
            ],

        ];
    }
}