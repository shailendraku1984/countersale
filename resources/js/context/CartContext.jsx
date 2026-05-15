import {
    createContext,
    useContext,
    useEffect,
    useState
} from 'react';

import api from '../services/api';

const CartContext = createContext();


export const CartProvider = ({ children }) => {

	const [cartItems, setCartItems] = useState([]);

    const [flashMessage, setFlashMessage] = useState('');
		

    /*
    |--------------------------------------------------------------------------
    | Load Cart
    |--------------------------------------------------------------------------
    */

    useEffect(() => {

        loadCart();

    }, []);

    const loadCart = async () => {

        try {

            const token = localStorage.getItem('token');

            /*
            |--------------------------------------------------------------------------
            | Logged In User
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

                const guestCart = JSON.parse(
                    localStorage.getItem('cart')
                ) || [];

                setCartItems(guestCart);
				setFlashMessage('Product added to cart');
				setTimeout(() => {

				setFlashMessage('');

			}, 3000);
            }

        } catch (error) {

            console.error(error);
        }
    };

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
            | Logged In User
            |--------------------------------------------------------------------------
            */

            if (token) {

                const response = await api.post('/cart/add', {

                    product_id: product.id,
                    quantity: 1,
                });

                setCartItems(response.data.cart);
				setFlashMessage('Product added to cart');
				setTimeout(() => {

					setFlashMessage('');

				}, 3000);

            } else {

                /*
                |--------------------------------------------------------------------------
                | Guest User
                |--------------------------------------------------------------------------
                */

                let cart = JSON.parse(
                    localStorage.getItem('cart')
                ) || [];

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

                localStorage.setItem(
                    'cart',
                    JSON.stringify(cart)
                );

                setCartItems(cart);
            }

        } catch (error) {

            console.error(error);
        }
    };
	
	
	const increaseQuantity = async (id) => {

    const token = localStorage.getItem('token');

    /*
    |--------------------------------------------------------------------------
    | Logged In User
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

        setCartItems(response.data.cart);

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

        localStorage.setItem(
            'cart',
            JSON.stringify(updatedCart)
        );

        setCartItems(updatedCart);
    }
};

const decreaseQuantity = async (id) => {

    const token = localStorage.getItem('token');

    const item = cartItems.find(
        item => item.id === id
    );

    if (item.quantity <= 1) {
        return;
    }

    /*
    |--------------------------------------------------------------------------
    | Logged In User
    |--------------------------------------------------------------------------
    */

    if (token) {

        const response = await api.put(

            `/cart/update/${id}`,

            {
                quantity: item.quantity - 1,
            }
        );

        setCartItems(response.data.cart);

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

        localStorage.setItem(
            'cart',
            JSON.stringify(updatedCart)
        );

        setCartItems(updatedCart);
    }
};

const removeFromCart = async (id) => {

    const token = localStorage.getItem('token');

    /*
    |--------------------------------------------------------------------------
    | Logged In User
    |--------------------------------------------------------------------------
    */

    if (token) {

        const response = await api.delete(
            `/cart/remove/${id}`
        );

        setCartItems(response.data.cart);

    } else {

        /*
        |--------------------------------------------------------------------------
        | Guest User
        |--------------------------------------------------------------------------
        */

        const updatedCart = cartItems.filter(
            item => item.id !== id
        );

        localStorage.setItem(
            'cart',
            JSON.stringify(updatedCart)
        );

        setCartItems(updatedCart);
    }
};


    return (

        <CartContext.Provider
            value={{
                cartItems,
                setCartItems,
                addToCart,
                loadCart,
				increaseQuantity,
				decreaseQuantity,
				removeFromCart,
				flashMessage,
            }}
        >

            {children}

        </CartContext.Provider>
    );
};

export const useCart = () => useContext(CartContext);