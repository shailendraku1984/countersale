import React, { useState } from 'react';

import { useNavigate } from 'react-router-dom';

import api from '../services/api';

export default function Login() {

    const navigate = useNavigate();

    const [form, setForm] = useState({
        email: '',
        password: '',
    });

    const [loading, setLoading] = useState(false);

    const [error, setError] = useState('');

    /*
    |--------------------------------------------------------------------------
    | Handle Input Change
    |--------------------------------------------------------------------------
    */

    const handleChange = (e) => {

        setForm({
            ...form,
            [e.target.name]: e.target.value,
        });
    };

    /*
    |--------------------------------------------------------------------------
    | Handle Login
    |--------------------------------------------------------------------------
    */

    const handleSubmit = async (e) => {

        e.preventDefault();

        setLoading(true);

        setError('');

        try {

            /*
            |--------------------------------------------------------------------------
            | Login API
            |--------------------------------------------------------------------------
            */

            const response = await api.post('/login', form);

            /*
            |--------------------------------------------------------------------------
            | Store Token
            |--------------------------------------------------------------------------
            */

            const token = response.data.token;

			/*
			|--------------------------------------------------------------------------
			| Store Token
			|--------------------------------------------------------------------------
			*/

			localStorage.setItem('token', token);

			/*
			|--------------------------------------------------------------------------
			| Attach Token To Axios
			|--------------------------------------------------------------------------
			*/

			api.defaults.headers.common[
				'Authorization'
			] = `Bearer ${token}`;

            /*
            |--------------------------------------------------------------------------
            | Sync Guest Cart
            |--------------------------------------------------------------------------
            */

            const guestCart = JSON.parse(
                localStorage.getItem('cart')
            );

            if (guestCart && guestCart.length > 0) {

                await api.post('/cart/sync', {

                    items: guestCart,
                });

                /*
                |--------------------------------------------------------------------------
                | Clear Guest Cart
                |--------------------------------------------------------------------------
                */

                localStorage.removeItem('cart');
            }

            /*
            |--------------------------------------------------------------------------
            | Redirect
            |--------------------------------------------------------------------------
            */

            navigate('/profile');

            /*
            |--------------------------------------------------------------------------
            | Error
            |--------------------------------------------------------------------------
            */

        } catch (err) {

            console.log(err);

			setError(
				err.response?.data?.message ||
				'Something went wrong'
			);

        } finally {

            setLoading(false);
        }
    };

    return (

        <div className="min-h-screen bg-gray-100 flex items-center justify-center px-4">

            <div className="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

                <div className="text-center mb-8">

                    <h1 className="text-3xl font-bold text-gray-800">
                        Welcome Back
                    </h1>

                    <p className="text-gray-500 mt-2">
                        Login to continue
                    </p>

                </div>

                {error && (

                    <div className="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-4">

                        {error}

                    </div>
                )}

                <form
                    onSubmit={handleSubmit}
                    className="space-y-5"
                >

                    <div>

                        <label className="block text-sm font-medium text-gray-700 mb-2">

                            Email

                        </label>

                        <input
                            type="email"
                            name="email"
                            value={form.email}
                            onChange={handleChange}
                            placeholder="admin@admin.com"
                            required
                            className="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        />

                    </div>

                    <div>

                        <label className="block text-sm font-medium text-gray-700 mb-2">

                            Password

                        </label>

                        <input
                            type="password"
                            name="password"
                            value={form.password}
                            onChange={handleChange}
                            placeholder="********"
                            required
                            className="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        />

                    </div>

                    <button
                        type="submit"
                        disabled={loading}
                        className="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition duration-300"
                    >

                        {loading
                            ? 'Please wait...'
                            : 'Login'}

                    </button>

                </form>

            </div>

        </div>
    );
}