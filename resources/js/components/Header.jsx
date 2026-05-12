import React from 'react';
import { Link } from 'react-router-dom';

export default function Header() {

    return (

        <header className="bg-white shadow-md sticky top-0 z-50">

            <div className="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

                {/* Logo */}

                <Link
                    to="/"
                    className="text-3xl font-bold text-indigo-600"
                >
                    Counter Sale
                </Link>

                {/* Navigation */}

                <nav className="hidden md:flex items-center gap-8 text-gray-700 font-medium">

                    <Link to="/" className="hover:text-indigo-600 transition">
                        Home
                    </Link>

                    <Link to="/products" className="hover:text-indigo-600 transition">
                        Products
                    </Link>

                    <Link to="/login" className="hover:text-indigo-600 transition">
                        Login
                    </Link>

                </nav>

                {/* Cart */}

                <button className="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-xl transition">
                    Cart (0)
                </button>

            </div>

        </header>
    );
}