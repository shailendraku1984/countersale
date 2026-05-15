import React from 'react';

import { Link } from 'react-router-dom';

import { useCart } from '../context/CartContext';

export default function Header() {

const { cartItems } = useCart();

const totalItems = cartItems.reduce(
    (total, item) => total + item.quantity,
    0
);
    //console.log(cartItems);
	
    return (

        <header className="bg-white shadow-md">

            <div className="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

                {/* Logo */}

                <Link
                    to="/"
                    className="text-4xl font-bold text-indigo-600"
                >
                    Counter Sale
                </Link>

                {/* Navigation */}

                <nav className="flex items-center gap-8">

                    <Link
                        to="/"
                        className="text-gray-700 hover:text-indigo-600 font-medium"
                    >
                        Home
                    </Link>

                    <Link
                        to="/products"
                        className="text-gray-700 hover:text-indigo-600 font-medium"
                    >
                        Products
                    </Link>

                    <Link
                        to="/login"
                        className="text-gray-700 hover:text-indigo-600 font-medium"
                    >
                        Login
                    </Link>

                    {/* Cart Button */}

                    <Link
                        to="/cart"
                        className="relative bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-xl transition"
                    >
                        Cart
						<span className="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full">
						{totalItems}

					</span>

                    </Link>

                </nav>

            </div>

        </header>
    );
}