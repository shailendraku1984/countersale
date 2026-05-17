import {
    createContext,
    useContext,
    useEffect,
    useState
} from 'react';

import api from '../services/api';

import {
    getGuestCart,
    saveGuestCart,
    clearGuestCart
} from '../utils/cart';

const CartContext = createContext();

export const CartProvider = ({ children }) => {

    const [cartItems, setCartItems] = useState([]);

    const [flashMessage, setFlashMessage] = useState('');

    /*
    |--------------------------------------------------------------------------
    | Flash Message Helper
    |--------------------------------------------------------------------------
    */

    const showFlashMessage = (message) => {

        setFlashMessage(message);

        setTimeout(() => {

            setFlashMessage('');

        }, 3000);
    };

    /*
    |--------------------------------------------------------------------------
    | Load Cart
    |--------------------------------------------------------------------------
    */

    const loadCart = async () => {

        try {

            const token = localStorage.getItem('token');

            /*
            |--------------------------------------------------------------------------
            | Logged-in User
            |--------------------------------------------------------------------------
            */

            if (token) {

                const response = await api.get('/cart');

                setCartItems(response.data.cart || []);

            } else {

                /*
                |--------------------------------------------------------------------------
                | Guest User
                |--------------------------------------------------------------------------
                */

                const guestCart = getGuestCart();

                setCartItems(guestCart);
            }

        } catch (error) {

            console.error(error);

            setCartItems([]);
        }
    };

    /*
    |--------------------------------------------------------------------------
    | Initial Load
    |--------------------------------------------------------------------------
    */

    useEffect(() => {

        loadCart();

    }, []);

    /*
    |--------------------------------------------------------------------------
    | Add To Cart
    |--------------------------------------------------------------------------
    */

    const addToCart = async (product) => {

        try {

            const token = localStorage.getItem('token');

            /*
            |--------------------------------------------------------------------------
            | Logged-in User
            |--------------------------------------------------------------------------
            */

            if (token) {

                const response = await api.post(
                    '/cart/add',
                    {
                        product_id: product.id,
                        quantity: 1,
                    }
                );

                setCartItems(response.data.cart || []);

            } else {

                /*
                |--------------------------------------------------------------------------
                | Guest User
                |--------------------------------------------------------------------------
                */

                let cart = getGuestCart();

                const existingItem = cart.find(
                    item => item.id === product.id
                );

                if (existingItem) {

                    existingItem.quantity += 1;

                } else {

                    cart.push({
                        ...product,
                        quantity: 1,
                    });
                }

                saveGuestCart(cart);

                setCartItems(cart);
            }

            showFlashMessage('Product added to cart');

        } catch (error) {

            console.error(error);
        }
    };

    /*
    |--------------------------------------------------------------------------
    | Increase Quantity
    |--------------------------------------------------------------------------
    */

    const increaseQuantity = async (id) => {

        try {

            const token = localStorage.getItem('token');

            /*
            |--------------------------------------------------------------------------
            | Logged-in User
            |--------------------------------------------------------------------------
            */

            if (token) {

                const item = cartItems.find(
                    item => item.id === id
                );

                const response = await api.put(
                    `/cart/update/${id}`,
                    {
                        quantity: item.quantity + 1,
                    }
                );

                setCartItems(response.data.cart || []);

            } else {

                /*
                |--------------------------------------------------------------------------
                | Guest User
                |--------------------------------------------------------------------------
                */

                const updatedCart = cartItems.map((item) =>

                    item.id === id

                        ? {
                            ...item,
                            quantity: item.quantity + 1,
                        }

                        : item
                );

                saveGuestCart(updatedCart);

                setCartItems(updatedCart);
            }

        } catch (error) {

            console.error(error);
        }
    };

    /*
    |--------------------------------------------------------------------------
    | Decrease Quantity
    |--------------------------------------------------------------------------
    */

    const decreaseQuantity = async (id) => {

        try {

            const token = localStorage.getItem('token');

            const item = cartItems.find(
                item => item.id === id
            );

            if (!item || item.quantity <= 1) {
                return;
            }

            /*
            |--------------------------------------------------------------------------
            | Logged-in User
            |--------------------------------------------------------------------------
            */

            if (token) {

                const response = await api.put(
                    `/cart/update/${id}`,
                    {
                        quantity: item.quantity - 1,
                    }
                );

                setCartItems(response.data.cart || []);

            } else {

                /*
                |--------------------------------------------------------------------------
                | Guest User
                |--------------------------------------------------------------------------
                */

                const updatedCart = cartItems.map((item) =>

                    item.id === id

                        ? {
                            ...item,
                            quantity: item.quantity - 1,
                        }

                        : item
                );

                saveGuestCart(updatedCart);

                setCartItems(updatedCart);
            }

        } catch (error) {

            console.error(error);
        }
    };

    /*
    |--------------------------------------------------------------------------
    | Remove From Cart
    |--------------------------------------------------------------------------
    */

    const removeFromCart = async (id) => {

        try {

            const token = localStorage.getItem('token');

            /*
            |--------------------------------------------------------------------------
            | Logged-in User
            |--------------------------------------------------------------------------
            */

            if (token) {

                const response = await api.delete(
                    `/cart/remove/${id}`
                );

                setCartItems(response.data.cart || []);

            } else {

                /*
                |--------------------------------------------------------------------------
                | Guest User
                |--------------------------------------------------------------------------
                */

                const updatedCart = cartItems.filter(
                    item => item.id !== id
                );

                saveGuestCart(updatedCart);

                setCartItems(updatedCart);
            }

            showFlashMessage('Product removed from cart');

        } catch (error) {

            console.error(error);
        }
    };

    /*
    |--------------------------------------------------------------------------
    | Logout Cart Backup
    |--------------------------------------------------------------------------
    */

    const backupCartToGuest = async () => {

        try {

            const token = localStorage.getItem('token');

            if (!token) {
                return;
            }

            const response = await api.get('/cart');

            const guestCart = response.data.cart || [];

            saveGuestCart(guestCart);

            setCartItems(guestCart);

        } catch (error) {

            console.error(error);
        }
    };

    return (

        <CartContext.Provider
            value={{

                cartItems,
                setCartItems,

                addToCart,
                increaseQuantity,
                decreaseQuantity,
                removeFromCart,

                loadCart,
                backupCartToGuest,

                flashMessage,

                clearGuestCart,
            }}
        >

            {children}

        </CartContext.Provider>
    );
};

export const useCart = () => useContext(CartContext);