import React, { useState } from 'react';

import { useNavigate } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';

import {
    getGuestCart,
    clearGuestCart
} from '../utils/cart';


export default function Register() {

    const navigate = useNavigate();

    const [form, setForm] = useState({
        email: '',
		name: '',
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
            | Register API
            |--------------------------------------------------------------------------
            */

            const response = await api.post('/register', form);

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

            const guestCart = getGuestCart();

            if (guestCart && guestCart.length > 0) {

                await api.post('/cart/sync', {

                    items: guestCart,
                });

                /*
                |--------------------------------------------------------------------------
                | Clear Guest Cart
                |--------------------------------------------------------------------------
                */

                clearGuestCart();
            }

            /*
            |--------------------------------------------------------------------------
            | Redirect
            |--------------------------------------------------------------------------
            */

			//navigate('/profile');
			window.location.href = '/profile';

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
       <MainLayout>
	   
        <div className="max-w-4xl mx-auto px-6 py-12">

            <div className="bg-white rounded-2xl shadow-lg overflow-hidden">

                <div className="bg-indigo-600 px-8 py-8 text-white">

					<h1 className="text-3xl font-bold">
						Create Your Account
					</h1>

					<p className="mt-2 text-indigo-100">
						Register to continue shopping
					</p>

				</div>

                {error && (

                    <div className="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-4">

                        {error}

                    </div>
                )}

                
				<div className="p-8">

					<form
						onSubmit={handleSubmit}
						className="grid grid-cols-1 md:grid-cols-2 gap-6"
					>
				    
					<div>

                        <label className="block text-sm font-medium text-gray-700 mb-2">

                            Your name

                        </label>

                        <input
                            type="text"
                            name="name"
                            value={form.name}
                            onChange={handleChange}
                            placeholder="like Ramesh Kr"
                            required
                            className="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        />

                    </div>
					

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
					
					
					<div>

                        <label className="block text-sm font-medium text-gray-700 mb-2">

                            Confirm Password

                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            value={form.password_confirmation}
                            onChange={handleChange}
                            placeholder="********"
                            required
                            className="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        />

                    </div>
					
					 
					
					<div className="md:col-span-2">

						<button
							type="submit"
							disabled={loading}
							className="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition duration-300"
						>
							{loading
								? 'Please wait...'
								: 'Create Account'}
						</button>

					</div>


                </form>
              </div>
            </div>

        </div>

    </MainLayout>
 
    );
}