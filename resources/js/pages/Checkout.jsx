import React, { useEffect, useState } from 'react';

import axios from 'axios';

import { useNavigate } from 'react-router-dom';

import MainLayout from '../layouts/MainLayout';

export default function Checkout() {

    const navigate = useNavigate();

    /*
    |--------------------------------------------------------------------------
    | State
    |--------------------------------------------------------------------------
    */

    const [cartItems, setCartItems] = useState([]);

    const [addresses, setAddresses] = useState([]);

    const [loading, setLoading] = useState(true);

    const [placingOrder, setPlacingOrder] = useState(false);

    const [successMessage, setSuccessMessage] = useState('');

    const [serverError, setServerError] = useState('');
	
	const [cartTotal, setCartTotal] = useState(0);

	const [paymentMethod, setPaymentMethod] = useState('cod');

    const [formData, setFormData] = useState({

        shipping_address_id: '',

        billing_address_id: '',

        payment_method: paymentMethod,

        notes: '',
    });

    /*
    |--------------------------------------------------------------------------
    | Fetch Checkout Data
    |--------------------------------------------------------------------------
    */

    useEffect(() => {

        fetchCheckoutData();

    }, []);

    const fetchCheckoutData = async () => {

        try {

            /*
            |--------------------------------------------------------------------------
            | Cart API
            |--------------------------------------------------------------------------
            */
            
			
            const cartResponse = await axios.get('/api/cart', { 
				
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`
                }
            });
			
			//console.log(cartResponse.data);
			
			//console.log(cartResponse.data.cart);
			
			//console.log(cartResponse.data.cart[0]);

            /*
            |--------------------------------------------------------------------------
            | Profile API
            |--------------------------------------------------------------------------
            */

            const profileResponse = await axios.get('/api/profile', {

                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`
                }
            });

             
			
			setCartItems(
				cartResponse.data.cart || []
			);
			
			setCartTotal(
				cartResponse.data.total || 0
			);

            const userAddresses =
                profileResponse.data.data?.addresses || [];

            setAddresses(userAddresses);

            /*
            |--------------------------------------------------------------------------
            | Default Address Selection
            |--------------------------------------------------------------------------
            */

            const shippingAddress = userAddresses.find(
                address => address.type === 'shipping'
            );

            const billingAddress = userAddresses.find(
                address => address.type === 'billing'
            );

            setFormData(prev => ({

                ...prev,

                shipping_address_id:
                    shippingAddress?.id || '',

                billing_address_id:
                    billingAddress?.id || '',
            }));

        } catch (error) {

            console.log(error);

            setServerError(
                'Failed to load checkout data.'
            );

        } finally {

            setLoading(false);
        }
    };

    /*
    |--------------------------------------------------------------------------
    | Handle Change
    |--------------------------------------------------------------------------
    */

    const handleChange = (e) => {

        setFormData({

            ...formData,

            [e.target.name]: e.target.value,
        });
    };

    /*
    |--------------------------------------------------------------------------
    | Calculate Total
    |--------------------------------------------------------------------------
    */

    const grandTotal = cartTotal;
	
     

    /*
    |--------------------------------------------------------------------------
    | Place Order
    |--------------------------------------------------------------------------
    */

    const handlePlaceOrder = async (e) => {

        e.preventDefault();

        setPlacingOrder(true);

        setServerError('');

        try {

            const response = await axios.post(

                '/api/orders',

                formData,

                {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`
                    }
                }
            );

            setSuccessMessage(
                response.data.message
            );

            /*
            |--------------------------------------------------------------------------
            | Redirect
            |--------------------------------------------------------------------------
            */

            setTimeout(() => {

                //navigate('/orders');
				window.location.href = '/orders';

            }, 1500);

        } catch (error) {

            console.log(error);

            setServerError(

                error.response?.data?.message ||

                'Failed to place order.'
            );

        } finally {

            setPlacingOrder(false);
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

                Loading Checkout...

            </div>
        );
    }
	
	


    return (

        <MainLayout>

            <div className="min-h-screen bg-gray-100 py-10">

                <div className="max-w-6xl mx-auto px-4">

                    <h1 className="text-3xl font-bold mb-8">

                        Checkout

                    </h1>

                    {/* Success */}

                    {
                        successMessage && (

                            <div className="bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-xl mb-6">

                                {successMessage}

                            </div>
                        )
                    }

                    {/* Error */}

                    {
                        serverError && (

                            <div className="bg-red-100 border border-red-300 text-red-700 px-5 py-4 rounded-xl mb-6">

                                {serverError}

                            </div>
                        )
                    }

                    <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">

                        {/* Left */}

                        <div className="lg:col-span-2">

                            <form onSubmit={handlePlaceOrder}>

                                {/* Shipping Address */}

                                <div className="bg-white rounded-2xl shadow p-6 mb-6">

                                    <h2 className="text-xl font-bold mb-5">

                                        Shipping Address

                                    </h2>

                                    <select
                                        name="shipping_address_id"
                                        value={formData.shipping_address_id}
                                        onChange={handleChange}
                                        className="w-full border border-gray-300 rounded-xl px-4 py-3"
                                    >

                                        <option value="">
                                            Select Shipping Address
                                        </option>

                                        {
                                            addresses.map(address => (

                                                <option
                                                    key={address.id}
                                                    value={address.id}
                                                >
                                                    {address.full_name} - {address.city}
                                                </option>
                                            ))
                                        }

                                    </select>

                                </div>

                                {/* Billing Address */}

                                <div className="bg-white rounded-2xl shadow p-6 mb-6">

                                    <h2 className="text-xl font-bold mb-5">

                                        Billing Address

                                    </h2>

                                    <select
                                        name="billing_address_id"
                                        value={formData.billing_address_id}
                                        onChange={handleChange}
                                        className="w-full border border-gray-300 rounded-xl px-4 py-3"
                                    >

                                        <option value="">
                                            Select Billing Address
                                        </option>

                                        {
                                            addresses.map(address => (

                                                <option
                                                    key={address.id}
                                                    value={address.id}
                                                >
                                                    {address.full_name} - {address.city}
                                                </option>
                                            ))
                                        }

                                    </select>

                                </div>

                                {/* Notes */}

                                <div className="bg-white rounded-2xl shadow p-6 mb-6">

                                    <h2 className="text-xl font-bold mb-5">

                                        Order Notes

                                    </h2>

                                    <textarea
                                        name="notes"
                                        value={formData.notes}
                                        onChange={handleChange}
                                        rows="4"
                                        className="w-full border border-gray-300 rounded-xl px-4 py-3"
                                        placeholder="Optional notes..."
                                    />

                                </div>
								
								
								<div className="bg-white rounded-2xl shadow p-6 mt-8">

									<h2 className="text-2xl font-bold mb-6">

										Payment Method

									</h2>

									<div className="space-y-4">

										{/* COD */}

										<label className="flex items-center gap-3 border rounded-xl p-4 cursor-pointer">

											<input
												type="radio"
												name="payment_method"
												value="cod"
												checked={paymentMethod === 'cod'}
												onChange={(e) => setPaymentMethod(e.target.value)}
											/>

											<div>

												<p className="font-semibold">

													Cash on Delivery

												</p>

												<p className="text-sm text-gray-500">

													Pay when order arrives

												</p>

											</div>

										</label>

										{/* Future Razorpay */}

										<label className="flex items-center gap-3 border rounded-xl p-4 opacity-50 cursor-not-allowed">

											<input
												type="radio"
												disabled
											/>

											<div>

												<p className="font-semibold">

													Razorpay

												</p>

												<p className="text-sm text-gray-500">

													Coming Soon

												</p>

											</div>

										</label>

									</div>

								</div>
                                 
								 <div>&nbsp;</div>

                                {/* Button */}

                                <button
                                    type="submit"
                                    disabled={placingOrder}
                                    className="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-xl font-semibold"
                                >

                                    {
                                        placingOrder
                                            ? 'Placing Order...'
                                            : 'Place Order'
                                    }

                                </button>

                            </form>

                        </div>

                        {/* Right */}

                        <div>

                            <div className="bg-white rounded-2xl shadow p-6 sticky top-5">

                                <h2 className="text-2xl font-bold mb-6">

                                    Order Summary

                                </h2>

                                {
                                    cartItems.map(item => (

                                         <div key={item.id}	className="flex justify-between border-b py-3">

												<div>

													<p className="font-semibold">

														{item.name}

													</p>

													<p className="text-sm text-gray-500">

														Qty: {item.quantity}

													</p>

												</div>

												<p className="font-bold">

													₹{Number(item.price) * item.quantity}

												</p>

											</div>
                                    ))
                                }

                                <div className="flex justify-between mt-6 text-xl font-bold">

                                    <span>
                                        Total
                                    </span>

                                    <span>
                                        ₹{grandTotal}
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </MainLayout>
    );
}