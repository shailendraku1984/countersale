import React from 'react';

import { Link, NavLink } from 'react-router-dom';

import { useCart } from '../context/CartContext';

import api from '../services/api';

export default function Header() {
	const baseURL = "http://localhost:8000/storage";

    const { cartItems } = useCart();

    const token = localStorage.getItem('token');

    /*
    |--------------------------------------------------------------------------
    | Active Nav Class
    |--------------------------------------------------------------------------
    */

    const navClass = ({ isActive }) =>

        isActive

            ? 'bg-indigo-600 text-white px-4 py-2 rounded-xl transition'

            : 'text-gray-700 hover:text-indigo-600 px-4 py-2 transition';

    /*
    |--------------------------------------------------------------------------
    | Total Cart Items
    |--------------------------------------------------------------------------
    */

    const totalItems = cartItems.reduce(

        (total, item) => total + item.quantity,

        0
    );

    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    const logout = async () => {

        try {

            /*
            |--------------------------------------------------------------------------
            | Get Current Cart
            |--------------------------------------------------------------------------
            */

            const cartResponse = await api.get('/cart');

            /*
            |--------------------------------------------------------------------------
            | Save Cart Into localStorage
            |--------------------------------------------------------------------------
            */

            localStorage.setItem(

                'cart',

                JSON.stringify(
                    cartResponse.data.cart || []
                )
            );

            /*
            |--------------------------------------------------------------------------
            | Logout API
            |--------------------------------------------------------------------------
            */

            await api.post('/logout');

        } catch (error) {

            console.log(error);

        } finally {

            /*
            |--------------------------------------------------------------------------
            | Remove Auth Data
            |--------------------------------------------------------------------------
            */

            localStorage.removeItem('token');

            localStorage.removeItem('user');

            /*
            |--------------------------------------------------------------------------
            | Redirect
            |--------------------------------------------------------------------------
            */

            window.location.href = '/login';
        }
    };

    return (

        <header className="bg-white shadow-md">

            <div className="max-w-7xl mx-auto px-4 py-4">

                <div className="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

                    {/* Logo */}
					
					
					
					<Link
                        to="/"
                        className="text-3xl md:text-4xl font-bold text-indigo-600 leading-none text-center md:text-left"
                    >
                    <img src={`${baseURL}/logo/counterSale.webp`} className="w-24 h-24 object-contain" />
 					</Link>
					
                     
                    {/* Navigation */}

                    <nav className="flex flex-wrap items-center justify-center md:justify-end gap-2 md:gap-3">

                        <NavLink
                            to="/"
                            className={navClass}
                        >
                            Home
                        </NavLink>

                        <NavLink
                            to="/products"
                            className={navClass}
                        >
                            Products
                        </NavLink>

                        {
                            token ? (

                                <>

                                    <NavLink
                                        to="/profile"
                                        className={navClass}
                                    >
                                        Profile
                                    </NavLink>

                                    <NavLink
                                        to="/orders"
                                        className={navClass}
                                    >
                                        Orders
                                    </NavLink>

                                    <button
                                        onClick={logout}
                                        className="text-gray-700 hover:text-red-600 px-4 py-2 transition"
                                    >
                                        Logout
                                    </button>

                                </>

                            ) : (

                                <>

                                    <NavLink
                                        to="/login"
                                        className={navClass}
                                    >
                                        Login
                                    </NavLink>

                                    <NavLink
                                        to="/register"
                                        className={navClass}
                                    >
                                        Register
                                    </NavLink>

                                </>
                            )
                        }

                        {/* Cart */}

                        <Link
                            to="/cart"
                            className="relative bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl transition"
                        >
                            Cart

                            {
                                totalItems > 0 && (

                                    <span className="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full">

                                        {totalItems}

                                    </span>
                                )
                            }

                        </Link>

                    </nav>

                </div>

            </div>

        </header>
    );
}