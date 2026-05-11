<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $productId = $this->route('product')?->id;

        return [
            'category' => ['required', 'integer', 'exists:categories,id'],
            'branch' => ['required', 'integer', 'exists:branches,id'],
            'warehouse' => ['required', 'integer', 'exists:warehouses,id'],
            'forSale' => ['required', 'integer', 'exists:forSale,id'],
            'forPurchase' => ['required', 'integer', 'exists:forPurchase,id'],
            'name' => ['required', 'max:255', Rule::unique('products', 'name')->ignore($productId)],
            'slug' => ['required', 'max:255', Rule::unique('products', 'slug')->ignore($productId)],
            'sku' => ['required', 'max:255', Rule::unique('products', 'sku')->ignore($productId)],
            'description' => ['nullable'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'tax_rate' => ['required', 'integer', 'exists:tax_rate,id'],
            'product_color' => ['nullable', 'integer', 'exists:product_color,id'],
            'product_size' => ['nullable', 'integer', 'exists:product_size,id'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status' => ['required', 'in:open,close'],
        ];
    }
}
