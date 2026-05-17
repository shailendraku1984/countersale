<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Cart List
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Guest Cart
        |--------------------------------------------------------------------------
        */

        if (!$request->user()) {

            return response()->json([
                'status' => true,
                'cart' => [],
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | User Cart
        |--------------------------------------------------------------------------
        */

        $cart = Cart::with('items.product')
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$cart) {

            return response()->json([
                'status' => true,
                'cart' => [],
            ]);
        }

        $items = $cart->items->map(function ($item) {

            return [

                'id' => $item->product->id,

                'name' => $item->product->product_name,

                'price' => $item->price,

                'quantity' => $item->quantity,

                'image' => $item->product->image
                    ? asset('storage/' . $item->product->image)
                    : null,
            ];
        });

        return response()->json([

            'status' => true,

            'cart' => $items,
        ]);
    }


	public function add(Request $request)
	{
		$request->validate([
			'product_id' => 'required|exists:products,id',
			'quantity'   => 'required|integer|min:1',
		]);

		if (!$request->user()) {

			return response()->json([
				'status' => false,
				'message' => 'Unauthorized',
			], 401);
		}

		DB::beginTransaction();

		try {

			$product = Product::findOrFail($request->product_id);

			$cart = Cart::firstOrCreate([
				'user_id' => $request->user()->id,
			]);

			$cartItem = CartItem::where('cart_id', $cart->id)
				->where('product_id', $product->id)
				->first();

			if ($cartItem) {

				$cartItem->quantity += $request->quantity;

				$cartItem->save();

			} else {

				CartItem::create([
					'cart_id'   => $cart->id,
					'product_id'=> $product->id,
					'quantity'  => $request->quantity,
					'price'     => $product->price,
				]);
			}

			DB::commit();

			return $this->index($request);

		} catch (\Exception $e) {

			DB::rollBack();

			return response()->json([
				'status' => false,
				'message' => $e->getMessage(),
			], 500);
		}
	}


 
    /*
    |--------------------------------------------------------------------------
    | Sync Cart
    |--------------------------------------------------------------------------
    */

    public function sync(Request $request)
    {
        $cart = Cart::firstOrCreate([
            'user_id' => $request->user()->id,
        ]);

        foreach ($request->items as $item) {

            $product = Product::find($item['id']);

            if (!$product) {
                continue;
            }

            $cartItem = CartItem::where(
                'cart_id',
                $cart->id
            )
            ->where(
                'product_id',
                $product->id
            )
            ->first();

            if ($cartItem) {

                $cartItem->quantity += $item['quantity'];

                $cartItem->save();

            } else {

                CartItem::create([

                    'cart_id' => $cart->id,

                    'product_id' => $product->id,

                    'quantity' => $item['quantity'],

                    'price' => $product->price,
                ]);
            }
        }

        return response()->json([

            'status' => true,

            'message' => 'Cart synced successfully',
        ]);
    }
	
	
	/*
	|--------------------------------------------------------------------------
	| Update Quantity
	|--------------------------------------------------------------------------
	*/
    public function update(Request $request, $productId)
	{
		$request->validate([
			'quantity' => 'required|integer|min:1',
		]);

		if (!$request->user()) {

			return response()->json([
				'status' => false,
				'message' => 'Unauthorized',
			], 401);
		}

		$cart = Cart::where(
			'user_id',
			$request->user()->id
		)->first();

		if (!$cart) {

			return response()->json([
				'status' => false,
				'message' => 'Cart not found',
			]);
		}

		$cartItem = CartItem::where(
			'cart_id',
			$cart->id
		)
		->where(
			'product_id',
			$productId
		)
		->first();

		if (!$cartItem) {

			return response()->json([
				'status' => false,
				'message' => 'Cart item not found',
			]);
		}

		$cartItem->quantity = $request->quantity;

		$cartItem->save();

		return $this->index($request);
	}

	public function update_pre(Request $request, $productId)
	{
		$cart = Cart::where(
			'user_id',
			$request->user()->id
		)->first();

		if (!$cart) {

			return response()->json([
				'status' => false,
			]);
		}

		$cartItem = CartItem::where(
			'cart_id',
			$cart->id
		)
		->where(
			'product_id',
			$productId
		)
		->first();

		if (!$cartItem) {

			return response()->json([
				'status' => false,
			]);
		}

		//$cartItem->quantity = $request->quantity;
		$request->validate(['quantity' => 'required|integer|min:1',]);

		$cartItem->save();

		return $this->index($request);
	}
	
	
	/*
|--------------------------------------------------------------------------
| Remove Item
|--------------------------------------------------------------------------
*/

public function remove(Request $request, $productId)
{
    $cart = Cart::where(
        'user_id',
        $request->user()->id
    )->first();

    if (!$cart) {

        return response()->json([
            'status' => false,
        ]);
    }

    CartItem::where(
        'cart_id',
        $cart->id
    )
    ->where(
        'product_id',
        $productId
    )
    ->delete();

    return $this->index($request);
}

}