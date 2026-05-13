import './bootstrap';
import '../css/app.css';

import React from 'react';
import ReactDOM from 'react-dom/client';
import Router from './router';
import './bootstrap';

ReactDOM.createRoot(document.getElementById('root')).render(

    <React.StrictMode>
        <Router />
    </React.StrictMode>

);

