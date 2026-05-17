import { useEffect } from 'react';

import { useNavigate } from 'react-router-dom';

import { useCart } from '../context/CartContext';

export default function Logout() {

    const navigate = useNavigate();

    const {
        backupCartToGuest
    } = useCart();

    useEffect(() => {

        const logoutUser = async () => {

            /*
            |--------------------------------------------------------------------------
            | Backup DB Cart To Guest Cart
            |--------------------------------------------------------------------------
            */

            await backupCartToGuest();

            /*
            |--------------------------------------------------------------------------
            | Remove Token
            |--------------------------------------------------------------------------
            */

            localStorage.removeItem('token');

            /*
            |--------------------------------------------------------------------------
            | Remove Auth Header
            |--------------------------------------------------------------------------
            */

            delete window.axios?.defaults?.headers?.common?.Authorization;

            /*
            |--------------------------------------------------------------------------
            | Reload Application
            |--------------------------------------------------------------------------
            */

            window.location.href = '/';
        };

        logoutUser();

    }, []);

    return null;
}