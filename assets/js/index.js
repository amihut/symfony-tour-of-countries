/*
 * App's index JavaScript file!
 */

import React from 'react';
import {Link} from "react-router-dom";
import '../css/app.scss';
import 'bootstrap';
import Routes from './routes';

const App = () => {
    return (
        <div>
            <nav className="navbar navbar-expand navbar-dark bg-dark sticky-top">
                <a href="/" className="navbar-brand">
                    Symfony Tour Of Countries
                </a>
                <div className="navbar-nav mr-auto">
                    <li className="nav-item">
                        <Link to={"/locations/countries"} className="nav-link">
                            Countries
                        </Link>
                    </li>
                </div>
            </nav>

            <div className="container mt-3">
                <Routes/>
            </div>
        </div>
    );
}

export default App;
