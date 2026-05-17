import './bootstrap';
import '../css/app.css';

import React from 'react';
import ReactDOM from 'react-dom/client';

import Router from './router';

import { CartProvider } from './context/CartContext';
//import Checkout from './pages/Checkout';

ReactDOM.createRoot(
    document.getElementById('root')
).render(

    <React.StrictMode>

        <CartProvider>

            <Router />

        </CartProvider>

    </React.StrictMode>
);