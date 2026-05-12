import React from 'react';

export default function ProductCard({ product }) {

    return (

        <div className="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">

            <img
                src={product.image}
                alt={product.name}
                className="w-full h-60 object-cover"
            />

            <div className="p-5">

                <h3 className="text-xl font-semibold text-gray-800 mb-2">
                    {product.name}
                </h3>

                <p className="text-gray-500 mb-4 line-clamp-2">
                    {product.description}
                </p>

                <div className="flex items-center justify-between">

                    <span className="text-2xl font-bold text-indigo-600">
                        ₹{product.price}
                    </span>

                    <button className="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">
                        Add to Cart
                    </button>

                </div>

            </div>

        </div>
    );
}