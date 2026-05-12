import React from 'react';

export default function Footer() {

    return (

        <footer className="bg-gray-900 text-white mt-20">

            <div className="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-3 gap-8">

                <div>

                    <h2 className="text-2xl font-bold text-indigo-400 mb-4">
                        Counter Sale
                    </h2>

                    <p className="text-gray-400 leading-7">
                        Professional ecommerce frontend built with Laravel and React.
                    </p>

                </div>

                <div>

                    <h3 className="text-xl font-semibold mb-4">
                        Quick Links
                    </h3>

                    <ul className="space-y-3 text-gray-400">
                        <li>Home</li>
                        <li>Products</li>
                        <li>Login</li>
                    </ul>

                </div>

                <div>

                    <h3 className="text-xl font-semibold mb-4">
                        Contact
                    </h3>

                    <p className="text-gray-400 leading-7">
                        support@countersale.com
                    </p>

                </div>

            </div>

            <div className="border-t border-gray-800 text-center py-4 text-gray-500 text-sm">
                © 2026 Counter Sale. All rights reserved.
            </div>

        </footer>
    );
}