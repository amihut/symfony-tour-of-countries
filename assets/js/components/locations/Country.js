import React, {useState, useEffect} from "react";
import CountryDataService from "../../services/locations/CountriesDataService";

const Country = (props) => {
    const initialCountryState = {
        id: null,
        name: "",
        code: "",
        prefix: ""
    };
    const [currentCountry, setCurrentCountry] = useState(initialCountryState);
    const [message, setMessage] = useState("");

    const getCountry = (id) => {
        CountryDataService
            .findById(id)
            .then(response => {
                if (response.data.results.length !== -1) {
                    setCurrentCountry(response.data.results[0]);
                }
            })
            .catch(e => {
                setCurrentCountry(initialCountryState);
            });
    };

    useEffect(() => {
        getCountry(props.match.params.id);
    }, [props.match.params.id]);

    const handleInputChange = (event) => {
        const {
            name,
            value
        } = event.target;
        setCurrentCountry({
            ...currentCountry,
            [name]: value
        });
    };

    const updateCountry = () => {
        CountryDataService
            .update(currentCountry.id, currentCountry)
            .then(response => {
                setMessage("The Country was updated successfully!");
            })
            .catch(e => {
                setMessage(e.message);
            });
    };

    return (

        <div>
            {currentCountry ? (
                <div className="edit-form">
                    <h4>Country</h4>
                    <form>
                        <div className="form-group">
                            <label htmlFor="name">Name</label>
                            <input
                                type="text"
                                className="form-control"
                                id="name"
                                name="name"
                                value={currentCountry.name}
                                onChange={handleInputChange}
                            />
                        </div>
                        <div className="form-group">
                            <label htmlFor="code">Code</label>
                            <input
                                type="text"
                                className="form-control"
                                id="code"
                                name="code"
                                value={currentCountry.code}
                                onChange={handleInputChange}
                            />
                        </div>
                        <div className="form-group">
                            <label htmlFor="prefix">Prefix</label>
                            <input
                                type="text"
                                className="form-control"
                                id="prefix"
                                name="prefix"
                                value={currentCountry.prefix}
                                onChange={handleInputChange}
                            />
                        </div>
                    </form>

                    <button
                        type="submit"
                        className="btn btn-success"
                        onClick={updateCountry}
                    >
                        Update
                    </button>
                    <p>{message}</p>
                </div>
            ) : ('')}
        </div>
    );
};

export default Country;
