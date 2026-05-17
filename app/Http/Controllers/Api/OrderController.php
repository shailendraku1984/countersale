<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreOrderRequest;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
	
	public function index()
	{
		$orders = Order::with('items')
			->where('user_id', auth()->id())
			->latest()
			->paginate(10);

		return response()->json([

			'status' => true,

			'data' => $orders,
		]);
	}
	
	
	public function show($id)
	{
		$order = Order::with('items')
			->where('user_id', auth()->id())
			->findOrFail($id);

		return response()->json([

			'status' => true,

			'data' => $order,
		]);
	}


    public function store(StoreOrderRequest $request)
    {
        $user = $request->user();

        /*
        |--------------------------------------------------------------------------
        | Get Cart
        |--------------------------------------------------------------------------
        */

        $cart = Cart::with('items.product')
            ->where('user_id', $user->id)
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Empty Cart
        |--------------------------------------------------------------------------
        */

        if (!$cart || $cart->items->count() === 0) {

            return response()->json([

                'status' => false,

                'message' => 'Cart is empty.',
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Calculate Totals
        |--------------------------------------------------------------------------
        */

        $subtotal = 0;

        foreach ($cart->items as $item) {

            /*
            |--------------------------------------------------------------------------
            | Product Missing
            |--------------------------------------------------------------------------
            */

            if (!$item->product) {

                return response()->json([

                    'status' => false,

                    'message' => 'Product not found.',
                ], 422);
            }

            /*
            |--------------------------------------------------------------------------
            | Stock Validation
            |--------------------------------------------------------------------------
            */

            if ($item->quantity > $item->product->stock) {

                return response()->json([

					'status' => false,

					'message' => "Only {$item->product->stock} item(s) available for {$item->product->name}.",
				], 422);
            }

            $subtotal += (

                $item->price * $item->quantity
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Pricing
        |--------------------------------------------------------------------------
        */

        $taxAmount = 0;

        $shippingAmount = 0;

        $discountAmount = 0;

        $grandTotal = (
            $subtotal +
            $taxAmount +
            $shippingAmount -
            $discountAmount
        );

        /*
        |--------------------------------------------------------------------------
        | Create Order
        |--------------------------------------------------------------------------
        */

        DB::beginTransaction();

        try {

            $order = Order::create([

                'user_id' => $user->id,

                'shipping_address_id' => $request->shipping_address_id,

                'billing_address_id' => $request->billing_address_id,

                'subtotal' => $subtotal,

                'tax_amount' => $taxAmount,

                'shipping_amount' => $shippingAmount,

                'discount_amount' => $discountAmount,

                'grand_total' => $grandTotal,

                'order_number' => 'ORD-' . strtoupper(uniqid()),

                'payment_method' => $request->payment_method,

                'payment_status' => 'pending',

                'order_status' => 'pending',

                'notes' => $request->notes,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Create Order Items
            |--------------------------------------------------------------------------
            */

            foreach ($cart->items as $item) {

                OrderItem::create([

                    'order_id' => $order->id,

                    'product_id' => $item->product_id,

                    'product_name' => $item->product->name,

                    'sku' => $item->product->sku,

                    'price' => $item->price,

                    'quantity' => $item->quantity,

                    'total' => (
                        $item->price * $item->quantity
                    ),
                ]);

                /*
                |--------------------------------------------------------------------------
                | Reduce Stock
                |--------------------------------------------------------------------------
                */

                $item->product->decrement(
                    'stock',
                    $item->quantity
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Clear Cart
            |--------------------------------------------------------------------------
            */

            $cart->items()->delete();

            DB::commit();

            return response()->json([

                'status' => true,

                'message' => 'Order placed successfully.',

                'data' => $order->load('items'),
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([

                'status' => false,

                'message' => $e->getMessage(),
            ], 500);
        }
    }
}