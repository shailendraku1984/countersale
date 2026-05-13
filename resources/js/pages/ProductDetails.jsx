import React, { useEffect, useState } from 'react';

import { useParams } from 'react-router-dom';

import api from '../services/api';

import MainLayout from '../layouts/MainLayout';

export default function ProductDetails() {

     const { id } = useParams();

	const [product, setProduct] = useState(null);

	const [loading, setLoading] = useState(true);
	
	useEffect(() => {

		fetchProduct();

	}, []);

    
	const fetchProduct = async () => {

		try {

			const response = await api.get(`/products/${id}`);

			setProduct(response.data.product);

		} catch (error) {

			console.log(error);

		} finally {

			setLoading(false);
		}
	};

	
	if (loading) {

		return (

			<div className="min-h-screen flex items-center justify-center">

				<div className="text-xl font-semibold">
					Loading product...
				</div>

			</div>
		);
	}

    return (

        <MainLayout>

            {/* Breadcrumb */}

            <section className="bg-gray-100 border-b">

                <div className="max-w-7xl mx-auto px-6 py-4 text-sm text-gray-600">

                    Home / Products / {product.name}

                </div>

            </section>

            {/* Product Section */}

            <section className="max-w-7xl mx-auto px-6 py-14">

                <div className="grid grid-cols-1 lg:grid-cols-2 gap-12">

                    {/* Product Image */}

                    <div className="bg-white rounded-3xl shadow-lg overflow-hidden">

                        <img
                            src={product.image}
                            alt={product.name}
                            className="w-full h-[550px] object-cover"
                        />

                    </div>

                    {/* Product Info */}

                    <div className="flex flex-col justify-center">
 
                        <h1 className="text-5xl font-bold text-gray-900 leading-tight mb-6">

                            {product.name}

                        </h1>

                        <p className="text-gray-600 text-lg leading-8 mb-8">

                            {product.description}

                        </p>

                        <div className="text-4xl font-bold text-indigo-600 mb-6">

                            ₹{product.price}

                        </div>

                        <div className="flex items-center gap-4 mb-8">

                            <span className="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-medium">

                                In Stock ({product.stock})

                            </span>

                            <span className="text-gray-500">

                                SKU: {product.sku}

                            </span>

                        </div>

                        {/* Quantity + Buttons */}

                        <div className="flex flex-col sm:flex-row gap-4">

                            <input
                                type="number"
                                defaultValue="1"
                                min="1"
                                className="w-28 border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            />

                            <button className="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-semibold transition">

                                Add To Cart

                            </button>

                            <button className="border border-gray-300 hover:bg-gray-100 px-8 py-4 rounded-2xl font-semibold transition">

                                Wishlist

                            </button>

                        </div>

                    </div>

                </div>

            </section>

            {/* Tabs Section */}

            <section className="max-w-7xl mx-auto px-6 pb-16">

                <div className="bg-white rounded-3xl shadow-lg p-8">

                    <h2 className="text-3xl font-bold text-gray-900 mb-6">

                        Product Description

                    </h2>

                    <p className="text-gray-600 leading-8 text-lg">

                        {product.description}

                    </p>

                </div>

            </section>

        </MainLayout>
    );
}