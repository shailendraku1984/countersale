import React from 'react';

import Header from '../components/Header';
import Footer from '../components/Footer';
import { useCart } from '../context/CartContext';

export default function MainLayout({ children }) {
	const {cartItems,flashMessage} = useCart();

    return (

        <div className="min-h-screen bg-gray-100 flex flex-col">
            {
				flashMessage && (

					<div className="fixed top-5 right-5 z-50">

						<div className="bg-green-600 text-white px-5 py-3 rounded-xl shadow-lg">

							{flashMessage}

						</div>

					</div>
				)
			}
            <Header />

            <main className="flex-grow">
                {children}
            </main>

            <Footer />

        </div>
    );
}