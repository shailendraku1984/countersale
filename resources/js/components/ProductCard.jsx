import React from 'react';
import { useState } from 'react';

import { useCart } from '../context/CartContext';

export default function ProductCard({ product }) {

 	const { addToCart } = useCart();
	const [successId, setSuccessId] = useState(null);
	const handleAddToCart = async (product) => {

		await addToCart(product);

		setSuccessId(product.id);

		setTimeout(() => {

			setSuccessId(null);

		}, 2000);
	};


    return (

        <div className="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">

            <img
                src={
                    product.image
                        ? product.image
                        : 'https://via.placeholder.com/400x300'
                }
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
                    
					{
						successId === product.id && (

							<div className="mb-2 text-sm text-green-600 font-medium">

								✔ Added to cart

							</div>
						)
					}

                     <button
						onClick={() => handleAddToCart(product)}
						disabled={successId === product.id}
						className={`

							w-full
							py-3
							rounded-xl
							text-white
							font-semibold
							transition-all
							duration-300

							${
								successId === product.id

									? 'bg-green-600'

									: 'bg-indigo-600 hover:bg-indigo-700'
							}
						`}
					>

						{
							successId === product.id

								? 'Added ✓'

								: 'Add To Cart'
						}

					</button>
					

                </div>

            </div>

        </div>
    );
}