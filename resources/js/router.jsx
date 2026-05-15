import React from 'react';

import {
    BrowserRouter,
    Routes,
    Route,
    Navigate,
} from 'react-router-dom';

import Home from './pages/Home';
import Login from './pages/Login';
import Profile from './pages/Profile';
import Products from './pages/Products';
import ProductDetails from './pages/ProductDetails';
import Cart from './pages/Cart';


function PrivateRoute({ children }) {

    const token = localStorage.getItem('token');

    return token ? children : <Navigate to="/login" />;
}

export default function Router() {

    return (

        <BrowserRouter>

            <Routes>

                <Route
                    path="/"
                    element={<Home />}
                />

                <Route
                    path="/login"
                    element={<Login />}
                />

                <Route path="/products" element={<Products />}/>
                
				<Route path="/cart" element={<Cart />}/>

                <Route
                    path="/profile"
                    element={
                        <PrivateRoute>
                            <Profile />
                        </PrivateRoute>
                    }
                />
				
				
				<Route
                    path="/products/:id"
                    element={
                            <ProductDetails />
                    }
                />
				
				<Route
                    path="/cart"
                    element={
                            <Cart />
                    }
                />
 				

            </Routes>

        </BrowserRouter>
    );
}