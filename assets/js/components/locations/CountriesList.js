import React, {useState, useEffect} from "react";
import CountriesDataService from "../../services/locations/CountriesDataService";
import {Link} from "react-router-dom";
import {Row, Col} from "reactstrap";
import Flag from "react-flagkit";

//TODO handle exceptions properly
const CountriesList = () => {
    const [countries, setCountries] = useState([]);
    const [searchCode, setSearchCode] = useState("");
    const [currentCountry, setCurrentCountry] = useState(null);
    const [currentIndex, setCurrentIndex] = useState(-1);
    const [message, setMessage] = useState("");

    useEffect(() => {
        findAllCountries();
    }, []);

    const findAllCountries = () => {
        CountriesDataService
            .getAll()
            .then(response => {
                setMessage("");
                setCountries(response.data.results);
            })
            .catch(e => {
                setMessage(e.message);
            });
    };

    const findByCode = () => {
        if (!searchCode) {
            return;
        }

        setCurrentCountry(null);
        setCurrentIndex(-1);

        CountriesDataService
            .findByCode(searchCode)
            .then(response => {
                setMessage("");
                setCountries(response.data.results);
            })
            .catch(e => {
                setMessage('Country Not Found');
            });
    };

    const onChangeSearchCode = (e) => {
        setSearchCode(e.target.value);
    };

    const onClearSearchCode = () => {
        if (!searchCode) {
            return;
        }

        setMessage("");
        setCurrentIndex(-1);
        setSearchCode("");
        setCurrentCountry(null);
        findAllCountries();
    };

    const setActiveCountry = (country, index) => {
        setCurrentCountry(country);
        setCurrentIndex(index);
    };

    const onSearchInputKeyDown = (event) => {
        if (event.key === 'Enter') {
            findByCode();
        }
    }

    return (
        <Row>
            <Col md={8}>
                <p>{message}</p>
                <div className="input-group mb-3">
                    <input
                        type="text"
                        className="form-control"
                        placeholder="Search by country iso code"
                        value={searchCode}
                        onChange={onChangeSearchCode}
                        onKeyDown={onSearchInputKeyDown}
                    />
                    <button onClick={onClearSearchCode} type="button" className="btn bg-transparent input-clear-btn">
                        <i className="fa fa-times"/>
                    </button>
                    <div className="input-group-append">
                        <button
                            className="btn btn-outline-secondary"
                            type="button"
                            onClick={findByCode}
                        >
                            Search
                        </button>
                    </div>
                </div>
            </Col>
            <Col md={6}>
                <h4>Countries List</h4>

                <ul className="list-group cursor-pointer">
                    {countries && countries.map((country, index) => (
                        <li
                            className={
                                "list-group-item " + (index === currentIndex ? "active" : "")
                            }
                            onClick={() => setActiveCountry(country, index)}
                            key={index}
                        >
                            {country.name}
                        </li>
                    ))}
                </ul>
            </Col>
            <Col md={6}>
                {currentCountry ? (
                    <div>
                        <h4>Country Details</h4>
                        <div>
                            <label><strong>Name:</strong></label>{" "}
                            {currentCountry.name}
                        </div>
                        <div>
                            <label><strong>Flag:</strong></label>{" "}
                            <Flag className="mr-3 opacity-8" country={currentCountry.code}/>
                        </div>
                        <div>
                            <label><strong>Code:</strong></label>{" "}
                            {currentCountry.code}
                        </div>

                        <div>
                            <label><strong>Prefix:</strong></label>{" "}
                            {currentCountry.prefix}
                        </div>
                        <Link
                            to={"/locations/countries/" + currentCountry.id}
                            className={"btn btn-success"}
                        >
                            Edit
                        </Link>
                    </div>
                ) : (
                     <div>
                         <h4>Country Details</h4>
                         <p>Please select a Country from the list...</p>
                     </div>
                 )}
            </Col>
        </Row>
    );
};

export default CountriesList;
