import React from 'react';
import { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';

export default function Profile() {

    const navigate = useNavigate();

    const [user, setUser] = useState(null);

    const [loading, setLoading] = useState(true);
	
	const [editMode, setEditMode] = useState(false);
	const [form, setForm] = useState({

		name: '',

		email: '',

		phone: '',
    });
	
	const handleChange = (e) => {

		setForm({

			...form,

			[e.target.name]: e.target.value,
		});
	};
	
	const updateProfile = async (e) => {

		e.preventDefault();

		try {

			const response = await api.put(

				'/profile/update',

				form
			);

			setUser(response.data.user);

			setEditMode(false);

		} catch (error) {

			console.log(error);
		}
	};


    useEffect(() => {

        fetchProfile();

    }, []);

    const fetchProfile = async () => {

        try {

            const response = await api.get('/profile');

            setUser(response.data.user);
			setForm({

				name: response.data.user.name || '',

				email: response.data.user.email || '',

				phone: response.data.user.phone || '',
			});

        } catch (error) {

            localStorage.removeItem('token');

            //navigate('/login');
			window.location.href = '/login';

        } finally {

            setLoading(false);
        }
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
      <MainLayout>  
        <div className="min-h-screen bg-gray-100">

            {/* Navbar */}


            {/* Main Content */}

            <main className="max-w-5xl mx-auto p-6">

                <div className="bg-white rounded-2xl shadow-lg overflow-hidden">

                    {/* Top Banner */}

                    <div className="bg-indigo-600 px-8 py-10 rounded-t-2xl text-white">

						<div className="flex items-center justify-between">

							<div>

								<h2 className="text-3xl font-bold">
									Welcome, {user?.name}
								</h2>

								<p className="mt-2 text-indigo-100">
									You are successfully logged into the system.
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

                    {/* Profile Details */}

                    {editMode ? (

<form onSubmit={updateProfile}>

    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">

        {/* Name */}

        <div className="bg-gray-50 rounded-xl p-5 border">

            <label className="block text-sm text-gray-500 mb-3">
                Full Name
            </label>

            <input
                type="text"
                name="name"
                value={form.name}
                onChange={handleChange}
                className="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
            />

        </div>

        {/* Email */}

        <div className="bg-gray-50 rounded-xl p-5 border">

            <label className="block text-sm text-gray-500 mb-3">
                Email Address
            </label>

            <input
                type="email"
                name="email"
                value={form.email}
                onChange={handleChange}
                className="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
            />

        </div>

        {/* Phone */}

        <div className="bg-gray-50 rounded-xl p-5 border">

            <label className="block text-sm text-gray-500 mb-3">
                Phone
            </label>

            <input
                type="text"
                name="phone"
                value={form.phone}
                onChange={handleChange}
                className="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
            />

        </div>

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
	<div>&nbsp;</div>

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

            </main>

        </div>
	</MainLayout>	
    );
}