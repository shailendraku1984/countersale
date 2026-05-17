import React, { useEffect, useState } from 'react';

import axios from 'axios';

import MainLayout from '../layouts/MainLayout';

export default function Orders() {

    const [orders, setOrders] = useState([]);

    const [loading, setLoading] = useState(true);

    const [serverError, setServerError] = useState('');

    useEffect(() => {

        fetchOrders();

    }, []);

    const fetchOrders = async () => {

        try {

            const response = await axios.get(

                '/api/orders',

                {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`
                    }
                }
            );

            console.log(response.data);

            setOrders(
				response.data.data.data || []
			);

        } catch (error) {

            console.log(error);

            setServerError(
                'Failed to load orders.'
            );

        } finally {

            setLoading(false);
        }
    };

    if (loading) {

        return (

            <div className="min-h-screen flex items-center justify-center">

                Loading Orders...

            </div>
        );
    }

    return (

        <MainLayout>

            <div className="min-h-screen bg-gray-100 py-10">

                <div className="max-w-6xl mx-auto px-4">

                    {/* Header */}

                    <div className="mb-8">

                        <h1 className="text-3xl font-bold">

                            My Orders

                        </h1>

                        <p className="text-gray-500 mt-2">

                            View your recent orders

                        </p>

                    </div>

                    {/* Error */}

                    {
                        serverError && (

                            <div className="bg-red-100 border border-red-300 text-red-700 px-5 py-4 rounded-xl mb-6">

                                {serverError}

                            </div>
                        )
                    }

                    {/* Empty Orders */}

                    {
                        orders.length === 0 && (

                            <div className="bg-white rounded-2xl shadow p-10 text-center">

                                <h2 className="text-2xl font-bold mb-4">

                                    No Orders Found

                                </h2>

                                <p className="text-gray-500">

                                    You have not placed any order yet.

                                </p>

                            </div>
                        )
                    }

                    {/* Orders List */}

                    {
                        orders.map(order => (

                            <div
                                key={order.id}
                                className="bg-white rounded-2xl shadow p-6 mb-6"
                            >

                                <div className="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                                    <div>

                                        <h2 className="text-xl font-bold">

                                            <a
												href={`/orders/${order.id}`}
												className="text-indigo-600 hover:underline"
											>

												{order.order_number}

											</a>

                                        </h2>

                                        <p className="text-gray-500 mt-1">

                                            Payment Method:
                                            {' '}
                                            <span className="font-semibold capitalize">

                                                {order.payment_method}

                                            </span>

                                        </p>

                                        <p className="text-gray-500 mt-1">

                                            Order Status:
                                            {' '}
                                            <span className="font-semibold capitalize">

                                                {order.order_status}

                                            </span>

                                        </p>

                                    </div>

                                    <div className="text-right">

                                        <p className="text-2xl font-bold">

                                            ₹{order.grand_total}

                                        </p>

                                        <p className="text-sm text-gray-500 mt-1">

                                            {
                                                new Date(order.created_at)
                                                    .toLocaleString()
                                            }

                                        </p>

                                    </div>

                                </div>

                                {/* Order Items */}

                                <div className="mt-6 border-t pt-5">

                                    <h3 className="font-bold mb-4">

                                        Order Items

                                    </h3>

                                    {
                                        order.items?.map(item => (

                                            <div
                                                key={item.id}
                                                className="flex justify-between border-b py-3"
                                            >

                                                <div>

                                                    <p className="font-semibold">

                                                        {item.product_name}

                                                    </p>

                                                    <p className="text-sm text-gray-500">

                                                        Qty: {item.quantity}

                                                    </p>

                                                </div>

                                                <div className="font-bold">

                                                    ₹{item.total}

                                                </div>

                                            </div>
                                        ))
                                    }

                                </div>

                            </div>
                        ))
                    }

                </div>

            </div>

        </MainLayout>
    );
}