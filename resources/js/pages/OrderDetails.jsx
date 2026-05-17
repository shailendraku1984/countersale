import React, { useEffect, useState } from 'react';

import axios from 'axios';

import { useParams } from 'react-router-dom';

import MainLayout from '../layouts/MainLayout';

export default function OrderDetails() {

    /*
    |--------------------------------------------------------------------------
    | Params
    |--------------------------------------------------------------------------
    */

    const { id } = useParams();

    /*
    |--------------------------------------------------------------------------
    | State
    |--------------------------------------------------------------------------
    */

    const [order, setOrder] = useState(null);

    const [loading, setLoading] = useState(true);

    const [serverError, setServerError] = useState('');

    /*
    |--------------------------------------------------------------------------
    | Fetch Order
    |--------------------------------------------------------------------------
    */

    useEffect(() => {

        fetchOrder();

    }, []);

    const fetchOrder = async () => {

        try {

            const response = await axios.get(

                `/api/orders/${id}`,

                {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`
                    }
                }
            );

            console.log(response.data);

            setOrder(
                response.data.data
            );

        } catch (error) {

            console.log(error);

            setServerError(
                'Failed to load order details.'
            );

        } finally {

            setLoading(false);
        }
    };

    /*
    |--------------------------------------------------------------------------
    | Loading
    |--------------------------------------------------------------------------
    */

    if (loading) {

        return (

            <div className="min-h-screen flex items-center justify-center">

                Loading Order Details...

            </div>
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Error
    |--------------------------------------------------------------------------
    */

    if (serverError) {

        return (

            <MainLayout>

                <div className="min-h-screen flex items-center justify-center">

                    <div className="bg-red-100 border border-red-300 text-red-700 px-6 py-5 rounded-xl">

                        {serverError}

                    </div>

                </div>

            </MainLayout>
        );
    }

    return (

        <MainLayout>

            <div className="min-h-screen bg-gray-100 py-10">

                <div className="max-w-5xl mx-auto px-4">

                    {/* Header */}

                    <div className="bg-white rounded-2xl shadow p-6 mb-8">

                        <div className="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

                            <div>

                                <h1 className="text-3xl font-bold">

                                    Order Details

                                </h1>

                                <p className="text-gray-500 mt-2">

                                    Order Number:
                                    {' '}
                                    <span className="font-semibold">

                                        {order?.order_number}

                                    </span>

                                </p>

                            </div>

                            <div className="text-right">

                                <p className="text-3xl font-bold">

                                    ₹{order?.grand_total}

                                </p>

                                <p className="text-sm text-gray-500 mt-1">

                                    {
                                        new Date(order?.created_at)
                                            .toLocaleString()
                                    }

                                </p>

                            </div>

                        </div>

                    </div>

                    {/* Order Info */}

                    <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                        {/* Payment */}

                        <div className="bg-white rounded-2xl shadow p-6">

                            <h2 className="font-bold text-lg mb-4">

                                Payment

                            </h2>

                            <p className="text-gray-600">

                                Method:
                                {' '}
                                <span className="font-semibold capitalize">

                                    {order?.payment_method}

                                </span>

                            </p>

                            <p className="text-gray-600 mt-2">

                                Status:
                                {' '}
                                <span className="font-semibold capitalize">

                                    {order?.payment_status}

                                </span>

                            </p>

                        </div>

                        {/* Order Status */}

                        <div className="bg-white rounded-2xl shadow p-6">

                            <h2 className="font-bold text-lg mb-4">

                                Order Status

                            </h2>

                            <p className="font-semibold capitalize text-indigo-600">

                                {order?.order_status}

                            </p>

                        </div>

                        {/* Notes */}

                        <div className="bg-white rounded-2xl shadow p-6">

                            <h2 className="font-bold text-lg mb-4">

                                Notes

                            </h2>

                            <p className="text-gray-600">

                                {order?.notes || 'No notes provided.'}

                            </p>

                        </div>

                    </div>

                    {/* Order Items */}

                    <div className="bg-white rounded-2xl shadow p-6">

                        <h2 className="text-2xl font-bold mb-6">

                            Order Items

                        </h2>

                        {
                            order?.items?.map(item => (

                                <div
                                    key={item.id}
                                    className="flex justify-between items-center border-b py-4"
                                >

                                    <div>

                                        <p className="font-semibold text-lg">

                                            {item.product_name}

                                        </p>

                                        <p className="text-sm text-gray-500 mt-1">

                                            SKU: {item.sku}

                                        </p>

                                        <p className="text-sm text-gray-500 mt-1">

                                            Qty: {item.quantity}

                                        </p>

                                    </div>

                                    <div className="text-right">

                                        <p className="font-bold text-lg">

                                            ₹{item.total}

                                        </p>

                                        <p className="text-sm text-gray-500 mt-1">

                                            ₹{item.price} each

                                        </p>

                                    </div>

                                </div>
                            ))
                        }

                    </div>

                </div>

            </div>

        </MainLayout>
    );
}