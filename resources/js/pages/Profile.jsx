import React, { useEffect, useState } from 'react';
import axios from 'axios';
import MainLayout from '../layouts/MainLayout';

export default function Profile() {

    const [user, setUser] = useState(null);

    const [loading, setLoading] = useState(true);

    const [editMode, setEditMode] = useState(false);

    const [errors, setErrors] = useState({});

    const [successMessage, setSuccessMessage] = useState('');

    const [serverError, setServerError] = useState('');

    const [formData, setFormData] = useState({

        name: '',
        phone: '',

        addresses: [

            {
                type: 'shipping',
                full_name: '',
                phone: '',
                country: '',
                state: '',
                city: '',
                zip_code: '',
                landmark: '',
                address_line_1: '',
                address_line_2: '',
                is_default: true,
            },

            {
                type: 'billing',
                full_name: '',
                phone: '',
                country: '',
                state: '',
                city: '',
                zip_code: '',
                landmark: '',
                address_line_1: '',
                address_line_2: '',
                is_default: false,
            }
        ]
    });

    /*
    |--------------------------------------------------------------------------
    | Fetch Profile
    |--------------------------------------------------------------------------
    */

    useEffect(() => {

        fetchProfile();

    }, []);

    const fetchProfile = async () => {

        try {

            const response = await axios.get('/api/profile', {

                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`
                }
            });

            const profileData = response.data.data;

            setUser(profileData);

            setFormData({

                name: profileData?.name || '',

                phone: profileData?.phone || '',

                addresses:

                    Array.isArray(profileData?.addresses) &&
                    profileData.addresses.length > 0

                        ? profileData.addresses

                        : [

                            {
                                type: 'shipping',
                                full_name: '',
                                phone: '',
                                country: '',
                                state: '',
                                city: '',
                                zip_code: '',
                                landmark: '',
                                address_line_1: '',
                                address_line_2: '',
                                is_default: true,
                            },

                            {
                                type: 'billing',
                                full_name: '',
                                phone: '',
                                country: '',
                                state: '',
                                city: '',
                                zip_code: '',
                                landmark: '',
                                address_line_1: '',
                                address_line_2: '',
                                is_default: false,
                            }
                        ]
            });

        } catch (error) {

            setServerError(
                error.response?.data?.message ||
                'Failed to load profile.'
            );

        } finally {

            setLoading(false);
        }
    };

    /*
    |--------------------------------------------------------------------------
    | Handle User Fields
    |--------------------------------------------------------------------------
    */

    const handleChange = (e) => {

        setFormData({
            ...formData,
            [e.target.name]: e.target.value,
        });

        setErrors({
            ...errors,
            [e.target.name]: null,
        });
    };

    /*
    |--------------------------------------------------------------------------
    | Handle Address Fields
    |--------------------------------------------------------------------------
    */

    const handleAddressChange = (index, e) => {

        const updatedAddresses = [...formData.addresses];

        updatedAddresses[index][e.target.name] = e.target.value;

        setFormData({
            ...formData,
            addresses: updatedAddresses,
        });

        setErrors({
            ...errors,
            [`addresses.${index}.${e.target.name}`]: null,
        });
    };

    /*
    |--------------------------------------------------------------------------
    | Update Profile
    |--------------------------------------------------------------------------
    */

    const handleSubmit = async (e) => {

        e.preventDefault();

        try {

            const response = await axios.put(
                '/api/profile',
                formData,
                {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`
                    }
                }
            );

            setSuccessMessage(response.data.message);

            setErrors({});

            setServerError('');

            setUser(response.data.data);

            setEditMode(false);

        } catch (error) {

            setSuccessMessage('');

            /*
            |--------------------------------------------------------------------------
            | Validation Errors
            |--------------------------------------------------------------------------
            */

            if (error.response?.status === 422) {

                setErrors(error.response.data.errors || {});

                setServerError('');

                /*
                |--------------------------------------------------------------------------
                | Scroll To First Error
                |--------------------------------------------------------------------------
                */

                setTimeout(() => {

                    const firstError = document.querySelector('.border-red-500');

                    if (firstError) {

                        firstError.scrollIntoView({

                            behavior: 'smooth',

                            block: 'center',
                        });
                    }

                }, 100);
            }

            /*
            |--------------------------------------------------------------------------
            | Server Error
            |--------------------------------------------------------------------------
            */

            else {

                setServerError(

                    error.response?.data?.message ||

                    'Something went wrong.'
                );
            }
        }
    };

    /*
    |--------------------------------------------------------------------------
    | Loading
    |--------------------------------------------------------------------------
    */

    if (loading) {

        return (

            <div className="min-h-screen flex items-center justify-center bg-gray-100">

                <div className="text-xl font-semibold text-gray-700">
                    Loading...
                </div>

            </div>
        );
    }

    return (

        <MainLayout>

            <div className="min-h-screen bg-gray-100">

                <main className="max-w-5xl mx-auto p-6">

                    <div className="bg-white rounded-2xl shadow-lg overflow-hidden">

                        {/* Header */}

                        <div className="bg-indigo-600 px-8 py-10 rounded-t-2xl text-white">

                            <div className="flex items-center justify-between">

                                <div>

                                    <h2 className="text-3xl font-bold">
                                        Welcome, {user?.name}
                                    </h2>

                                    <p className="mt-2 text-indigo-100">
                                        Manage your profile and addresses
                                    </p>

                                </div>

                                <button
                                    onClick={() => setEditMode(!editMode)}
                                    className="bg-white text-indigo-600 hover:bg-indigo-50 px-5 py-2 rounded-xl font-semibold transition"
                                >
                                    {editMode ? 'Cancel' : 'Edit Profile'}
                                </button>

                            </div>

                        </div>

                        {/* Content */}

                        <div className="p-8">

                            {/* Success Message */}

                            {
                                successMessage && (

                                    <div className="bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-xl mb-6">

                                        {successMessage}

                                    </div>
                                )
                            }

                            {/* Server Error */}

                            {
                                serverError && (

                                    <div className="bg-red-100 border border-red-300 text-red-700 px-5 py-4 rounded-xl mb-6">

                                        {serverError}

                                    </div>
                                )
                            }

                            {editMode ? (

                                <form onSubmit={handleSubmit}>

                                    {/* Basic Info */}

                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">

                                        {/* Name */}

                                        <div className="bg-gray-50 rounded-xl p-5 border">

                                            <label className="block text-sm text-gray-500 mb-3">
                                                Full Name
                                            </label>

                                            <input
                                                type="text"
                                                name="name"
                                                value={formData.name}
                                                onChange={handleChange}
                                                className={`w-full border rounded-xl px-4 py-3 focus:ring-2 focus:outline-none ${
                                                    errors.name
                                                        ? 'border-red-500 focus:ring-red-500'
                                                        : 'border-gray-300 focus:ring-indigo-500'
                                                }`}
                                            />

                                            {
                                                errors.name && (

                                                    <p className="text-red-500 text-sm mt-2">

                                                        {errors.name[0]}

                                                    </p>
                                                )
                                            }

                                        </div>

                                        {/* Phone */}

                                        <div className="bg-gray-50 rounded-xl p-5 border">

                                            <label className="block text-sm text-gray-500 mb-3">
                                                Phone
                                            </label>

                                            <input
                                                type="text"
                                                name="phone"
                                                value={formData.phone}
                                                onChange={handleChange}
                                                className="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                                            />

                                        </div>

                                    </div>

                                    {/* Addresses */}

                                    <div className="mt-10">

                                        <h3 className="text-2xl font-bold mb-6">
                                            Addresses
                                        </h3>

                                        {
                                            Array.isArray(formData.addresses) &&
                                            formData.addresses.map((address, index) => (

                                                <div
                                                    key={index}
                                                    className="bg-gray-50 border rounded-2xl p-6 mb-8"
                                                >

                                                    <h4 className="text-xl font-semibold mb-5 capitalize">
                                                        {address.type} Address
                                                    </h4>

                                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-5">

                                                        {/* Full Name */}

                                                        <div>

                                                            <label className="block text-sm text-gray-500 mb-2">
                                                                Full Name
                                                            </label>

                                                            <input
                                                                type="text"
                                                                name="full_name"
                                                                value={address.full_name || ''}
                                                                onChange={(e) => handleAddressChange(index, e)}
                                                                className={`w-full border rounded-xl px-4 py-3 ${
                                                                    errors[`addresses.${index}.full_name`]
                                                                        ? 'border-red-500'
                                                                        : 'border-gray-300'
                                                                }`}
                                                            />

                                                            {
                                                                errors[`addresses.${index}.full_name`] && (

                                                                    <p className="text-red-500 text-sm mt-2">

                                                                        {errors[`addresses.${index}.full_name`][0]}

                                                                    </p>
                                                                )
                                                            }

                                                        </div>

                                                        {/* Country */}

                                                        <div>

                                                            <label className="block text-sm text-gray-500 mb-2">
                                                                Country
                                                            </label>

                                                            <input
                                                                type="text"
                                                                name="country"
                                                                value={address.country || ''}
                                                                onChange={(e) => handleAddressChange(index, e)}
                                                                className="w-full border border-gray-300 rounded-xl px-4 py-3"
                                                            />

                                                        </div>

                                                        {/* State */}

                                                        <div>

                                                            <label className="block text-sm text-gray-500 mb-2">
                                                                State
                                                            </label>

                                                            <input
                                                                type="text"
                                                                name="state"
                                                                value={address.state || ''}
                                                                onChange={(e) => handleAddressChange(index, e)}
                                                                className="w-full border border-gray-300 rounded-xl px-4 py-3"
                                                            />

                                                        </div>

                                                        {/* City */}

                                                        <div>

                                                            <label className="block text-sm text-gray-500 mb-2">
                                                                City
                                                            </label>

                                                            <input
                                                                type="text"
                                                                name="city"
                                                                value={address.city || ''}
                                                                onChange={(e) => handleAddressChange(index, e)}
                                                                className="w-full border border-gray-300 rounded-xl px-4 py-3"
                                                            />

                                                        </div>

                                                        {/* Address Line 1 */}

                                                        <div className="md:col-span-2">

                                                            <label className="block text-sm text-gray-500 mb-2">
                                                                Address Line 1
                                                            </label>

                                                            <textarea
                                                                name="address_line_1"
                                                                value={address.address_line_1 || ''}
                                                                onChange={(e) => handleAddressChange(index, e)}
                                                                className="w-full border border-gray-300 rounded-xl px-4 py-3"
                                                            />

                                                        </div>

                                                    </div>

                                                </div>
                                            ))
                                        }

                                    </div>

                                    {/* Buttons */}

                                    <div className="flex gap-4 mt-8">

                                        <button
                                            type="submit"
                                            className="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-semibold"
                                        >
                                            Update Profile
                                        </button>

                                        <button
                                            type="button"
                                            onClick={() => setEditMode(false)}
                                            className="bg-gray-200 hover:bg-gray-300 px-6 py-3 rounded-xl font-semibold"
                                        >
                                            Cancel
                                        </button>

                                    </div>

                                </form>

                            ) : (

                                <div className="grid grid-cols-1 md:grid-cols-2 gap-6">

                                    <div className="bg-gray-50 rounded-xl p-5 border">

                                        <p className="text-sm text-gray-500 mb-1">
                                            Full Name
                                        </p>

                                        <p className="text-lg font-semibold text-gray-800">
                                            {user?.name}
                                        </p>

                                    </div>

                                    <div className="bg-gray-50 rounded-xl p-5 border">

                                        <p className="text-sm text-gray-500 mb-1">
                                            Email Address
                                        </p>

                                        <p className="text-lg font-semibold text-gray-800">
                                            {user?.email}
                                        </p>

                                    </div>

                                    <div className="bg-gray-50 rounded-xl p-5 border">

                                        <p className="text-sm text-gray-500 mb-1">
                                            Phone
                                        </p>

                                        <p className="text-lg font-semibold text-gray-800">
                                            {user?.phone || 'N/A'}
                                        </p>

                                    </div>

                                </div>

                            )}

                        </div>

                    </div>

                </main>

            </div>

        </MainLayout>
    );
}