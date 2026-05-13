<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();

        $products->transform(function ($product) {

            $product->image = $product->image ? asset('storage/' . $product->image) : null;

            return $product;
        });

        return response()->json([
            'status' => true,
            'products' => $products,
        ]);
    }
	
	public function show($id)
	{
		$product = Product::findOrFail($id);
		$product->image = $product->image ? asset('storage/' . $product->image) : null;

		return response()->json([
			'status' => true,
			'product' => $product,
		]);
	}
	
}