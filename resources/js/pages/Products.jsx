import React, { useEffect, useState } from 'react';

import MainLayout from '../layouts/MainLayout';
import ProductCard from '../components/ProductCard';

import api from '../services/api';

export default function Products() {

    const [products, setProducts] = useState([]);

    const [categories, setCategories] = useState([]);

    const [selectedCategory, setSelectedCategory] = useState('');

    const [search, setSearch] = useState('');

    const [loading, setLoading] = useState(true);

    useEffect(() => {

        fetchProducts();

        fetchCategories();

    }, []);

    useEffect(() => {

        fetchProducts();

    }, [selectedCategory]);

    const fetchProducts = async () => {

        try {

            setLoading(true);

            let url = '/products';

            if (selectedCategory) {

                url += `?category=${selectedCategory}`;
            }

            const response = await api.get(url);

            setProducts(response.data.products);

        } catch (error) {

            console.log(error);

        } finally {

            setLoading(false);
        }
    };

    const fetchCategories = async () => {

        try {

            const response = await api.get('/categories');

            setCategories(response.data.categories);

        } catch (error) {

            console.log(error);
        }
    };

    const filteredProducts = products.filter((product) =>
        product.name
            .toLowerCase()
            .includes(search.toLowerCase())
    );

    return (

        <MainLayout>

            {/* Banner */}

            <section className="bg-indigo-600 text-white py-20">

                <div className="max-w-7xl mx-auto px-6 text-center">

                    <h1 className="text-5xl font-bold mb-5">
                        All Products
                    </h1>

                    <p className="text-xl text-indigo-100">
                        Explore our latest ecommerce collection
                    </p>

                </div>

            </section>

            {/* Filters */}

            <section className="max-w-7xl mx-auto px-6 py-10">

                <div className="bg-white rounded-2xl shadow-md p-6 flex flex-col lg:flex-row gap-4 justify-between items-center">

                    {/* Search */}

                    <input
                        type="text"
                        placeholder="Search products..."
                        value={search}
                        onChange={(e) => setSearch(e.target.value)}
                        className="border border-gray-300 rounded-xl px-4 py-3 w-full lg:w-1/3 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    />

                    {/* Category Filter */}

                     <select
						value={selectedCategory}
						onChange={(e) => setSelectedCategory(e.target.value)}
						className="border border-gray-300 rounded-xl px-4 py-3 w-full lg:w-60 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
					>

						<option value="">
							All Categories
						</option>

						{categories.map((category) => (

							<option
								key={category.id}
								value={category.id}
							>
								{category.category_name}
							</option>

						))}

					</select>

                    {/* Product Count */}

                    <div className="text-gray-600 font-semibold">

                        {filteredProducts.length} Products Found

                    </div>

                </div>

            </section>

            {/* Loading */}

            {loading ? (

                <div className="min-h-screen flex items-center justify-center">

                    <div className="text-xl font-semibold">
                        Loading products...
                    </div>

                </div>

            ) : (

                /* Product Listing */

                <section className="max-w-7xl mx-auto px-6 pb-16">

                    {filteredProducts.length > 0 ? (

                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                            {filteredProducts.map((product) => (

                                <ProductCard
                                    key={product.id}
                                    product={product}
                                />

                            ))}

                        </div>

                    ) : (

                        <div className="bg-white rounded-2xl shadow-md p-10 text-center">

                            <h2 className="text-2xl font-bold text-gray-700 mb-3">
                                No Products Found
                            </h2>

                            <p className="text-gray-500">
                                Try changing search or category filter.
                            </p>

                        </div>

                    )}

                </section>

            )}

        </MainLayout>
    );
}