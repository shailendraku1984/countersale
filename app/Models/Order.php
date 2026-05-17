<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $fillable = [

		'user_id',
		'shipping_address_id',
		'billing_address_id',
		'subtotal',
		'tax_amount',
		'shipping_amount',
		'discount_amount',
		'grand_total',
		'order_number',
		'payment_method',
		'payment_status',
		'order_status',
		'notes',
	];

    public function items()
	{
		return $this->hasMany(OrderItem::class);
	}


	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function shippingAddress()
	{
		return $this->belongsTo(UserAddress::class, 'shipping_address_id');
	}

	public function billingAddress()
	{
		return $this->belongsTo(UserAddress::class, 'billing_address_id');
	}

}
