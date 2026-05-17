import React from 'react';

import MainLayout from '../layouts/MainLayout';

import { useCart } from '../context/CartContext';

import { Link, useNavigate } from 'react-router-dom';



export default function Cart() {
 

    const navigate = useNavigate();

    const {

        cartItems,
        removeFromCart,
        increaseQuantity,
        decreaseQuantity,
		

    } = useCart();

    /*
    |--------------------------------------------------------------------------
    | Total Amount
    |--------------------------------------------------------------------------
    */

    const total = cartItems.reduce(

    (sum, item) =>

        sum + (item.price * item.quantity),

    0
    );

    /*
    |--------------------------------------------------------------------------
    | Checkout
    |--------------------------------------------------------------------------
    */

    const handleCheckout = () => {

        const token = localStorage.getItem('token');

        if (token) {

            navigate('/checkout');
			

        } else {

            navigate('/login');
        }
    };

    /*
    |--------------------------------------------------------------------------
    | Empty Cart
    |--------------------------------------------------------------------------
    */

    if (cartItems.length === 0) {

        return (

            <MainLayout>

                <div className="max-w-4xl mx-auto px-6 py-20 text-center">

                    <h1 className="text-4xl font-bold text-gray-800 mb-4">

                        Your Cart is Empty

                    </h1>

                    <p className="text-gray-500 mb-8">

                        Add some products to continue shopping

                    </p>

                    <Link
                        to="/products"
                        className="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl"
                    >

                        Continue Shopping

                    </Link>

                </div>

            </MainLayout>
        );
    }

    return (

        <MainLayout>

            <div className="max-w-7xl mx-auto px-6 py-12">

                <h1 className="text-4xl font-bold text-gray-800 mb-10">

                    Shopping Cart

                </h1>

                <div className="grid lg:grid-cols-3 gap-10">

                    {/* Cart Items */}

                    <div className="lg:col-span-2 space-y-6">

                        {cartItems.map((item) => (

                            <div
                                key={item.id}
                                className="bg-white rounded-2xl shadow-md p-5 flex flex-col md:flex-row gap-5 items-center"
                            >

                                {/* Image */}

                                <img
                                    src={item.image}
                                    alt={item.name}
                                    className="w-32 h-32 object-cover rounded-xl"
                                />

                                {/* Info */}

                                <div className="flex-grow">

                                    <h2 className="text-2xl font-semibold text-gray-800">

                                        {item.name}

                                    </h2>

                                    <p className="text-indigo-600 text-xl font-bold mt-2">

                                        ₹{item.price}

                                    </p>

                                </div>

                                {/* Quantity */}

                                <div className="flex items-center gap-3">

                                    <button
                                        onClick={() => decreaseQuantity(item.id)}
                                        className="bg-gray-200 hover:bg-gray-300 w-8 h-8 rounded-full"
                                    >

                                        -

                                    </button>

                                    <span className="text-lg font-semibold">

                                        {item.quantity}

                                    </span>

                                    <button
                                        onClick={() => increaseQuantity(item.id)}
                                        className="bg-gray-200 hover:bg-gray-300 w-8 h-8 rounded-full"
                                    >

                                        +

                                    </button>

                                </div>

                                {/* Subtotal */}

                                <div className="text-right">

                                    <div className="text-right">

										<p className="text-sm text-gray-500">
											Subtotal
										</p>

										<p className="text-lg font-bold text-gray-800">

											₹{item.price * item.quantity}

										</p>

									</div>

                                    <button
                                        onClick={() => removeFromCart(item.id)}
                                        className="text-red-500 hover:text-red-700 mt-2"
                                    >

                                        Remove

                                    </button>

                                </div>

                            </div>
                        ))}

                    </div>

                    {/* Summary */}

                    <div className="bg-white rounded-2xl shadow-md p-6 h-fit">

                        <h2 className="text-2xl font-bold text-gray-800 mb-6">

                            Order Summary

                        </h2>

                        <div className="flex justify-between mb-4">

                            <span className="text-gray-600">

                                Total

                            </span>

                            <span className="text-2xl font-bold text-indigo-600">

                                ₹{total}

                            </span>

                        </div>

                        <button
                            onClick={handleCheckout}
                            className="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-semibold transition"
                        >

                            Proceed To Checkout

                        </button>

                    </div>

                </div>

            </div>

        </MainLayout>
    );
}