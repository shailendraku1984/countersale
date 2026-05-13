import React from 'react';
import { Link } from 'react-router-dom';

export default function ProductCard({ product }) {

    return (
        
        <div className="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
            <Link to={`/products/${product.id}`}>  
            <img
                src={
                    product.image
                        ? product.image
                        : 'https://via.placeholder.com/400x300'
                }
                alt={product.name}
                className="w-full h-60 object-cover"
            />
			</Link>

            <div className="p-5">

                <h3 className="text-xl font-semibold text-gray-800 mb-2">
                    <Link to={`/products/${product.id}`}>{product.name}</Link>
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