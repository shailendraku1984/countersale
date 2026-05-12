import React from 'react';

import MainLayout from '../layouts/MainLayout';
import ProductCard from '../components/ProductCard';
export default function Home() {
	
    const products = [

        {
            id: 1,
            name: 'Apple iPhone 15',
            price: 79999,
            description: 'Latest Apple smartphone with powerful performance.',
            image: 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=1200&auto=format&fit=crop',
        },

        {
            id: 2,
            name: 'Samsung Galaxy S25',
            price: 74999,
            description: 'Premium Android flagship device for modern users.',
            image: 'https://images.unsplash.com/photo-1598327105666-5b89351aff97?q=80&w=1200&auto=format&fit=crop',
        },

        {
            id: 3,
            name: 'Sony Headphones',
            price: 12999,
            description: 'Noise cancellation wireless headphones.',
            image: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=1200&auto=format&fit=crop',
        },

        {
            id: 4,
            name: 'Smart Watch',
            price: 9999,
            description: 'Track your health and daily activity.',
            image: 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1200&auto=format&fit=crop',
        },

    ];

    return (

        <MainLayout>

            {/* Hero Section */}

            <section className="bg-indigo-600 text-white py-24">

                <div className="max-w-7xl mx-auto px-6 text-center">

                    <h1 className="text-5xl font-bold mb-6">
                        Modern Ecommerce Store
                    </h1>

                    <p className="text-xl text-indigo-100 max-w-3xl mx-auto leading-8">
                        Build powerful ecommerce experiences with Laravel and React.
                    </p>

                    <button className="mt-8 bg-white text-indigo-600 px-8 py-4 rounded-xl font-semibold hover:bg-gray-100 transition">
                        Shop Now
                    </button>

                </div>

            </section>

            {/* Product Section */}

            <section className="max-w-7xl mx-auto px-6 py-16">

                <div className="flex items-center justify-between mb-10">

                    <h2 className="text-3xl font-bold text-gray-800">
                        Featured Products
                    </h2>

                </div>

                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                    {products.map((product) => (

                        <ProductCard
                            key={product.id}
                            product={product}
                        />

                    ))}

                </div>

            </section>

        </MainLayout>
    );
}