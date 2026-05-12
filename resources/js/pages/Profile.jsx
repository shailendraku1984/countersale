import React from 'react';
import { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import api from '../services/api';

export default function Profile() {

    const navigate = useNavigate();

    const [user, setUser] = useState(null);

    const [loading, setLoading] = useState(true);

    useEffect(() => {

        fetchProfile();

    }, []);

    const fetchProfile = async () => {

        try {

            const response = await api.get('/profile');

            setUser(response.data.user);

        } catch (error) {

            localStorage.removeItem('token');

            navigate('/login');

        } finally {

            setLoading(false);
        }
    };

    const logout = async () => {

        try {

            await api.post('/logout');

        } catch (error) {

            console.log(error);
        }

        localStorage.removeItem('token');

        navigate('/login');
    };

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

        <div className="min-h-screen bg-gray-100">

            {/* Navbar */}

            <header className="bg-white shadow-md">

                <div className="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

                    <div>

                        <h1 className="text-2xl font-bold text-indigo-600">
                            Counter Sale
                        </h1>

                        <p className="text-sm text-gray-500">
                            React Dashboard
                        </p>

                    </div>

                    <button
                        onClick={logout}
                        className="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-lg shadow transition duration-300"
                    >
                        Logout
                    </button>

                </div>

            </header>

            {/* Main Content */}

            <main className="max-w-5xl mx-auto p-6">

                <div className="bg-white rounded-2xl shadow-lg overflow-hidden">

                    {/* Top Banner */}

                    <div className="bg-indigo-600 px-8 py-10 text-white">

                        <h2 className="text-3xl font-bold">
                            Welcome, {user?.name}
                        </h2>

                        <p className="mt-2 text-indigo-100">
                            You are successfully logged into the system.
                        </p>

                    </div>

                    {/* Profile Details */}

                    <div className="p-8">

                        <h3 className="text-xl font-semibold text-gray-800 mb-6">
                            Profile Information
                        </h3>

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
                                    User ID
                                </p>

                                <p className="text-lg font-semibold text-gray-800">
                                    #{user?.id}
                                </p>

                            </div>

                            <div className="bg-gray-50 rounded-xl p-5 border">

                                <p className="text-sm text-gray-500 mb-1">
                                    Status
                                </p>

                                <p className="text-green-600 font-semibold">
                                    Active
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </main>

        </div>
    );
}