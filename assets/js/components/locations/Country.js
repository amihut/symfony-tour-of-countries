import React, {useState, useEffect} from "react";
import CountryDataService from "../../services/locations/CountriesDataService";

const Country = (props) => {
    const initialCountryState = {
        id: null,
        name: "",
        code: "",
        prefix: "",
        comments: []
    };

    const initialCountryMeta = {
        count: 0,
        commentsCount: 0
    }

    const [currentCountry, setCurrentCountry] = useState(initialCountryState);
    const [countryMeta, setCountryMeta] = useState(initialCountryMeta);
    const [message, setMessage] = useState("");
    const [comment, setComment] = useState("");

    const getCountry = (id) => {
        CountryDataService
            .findById(id)
            .then(response => {
                setCurrentCountry(response.data.results[0]);
                setCountryMeta(response.data.meta);
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

    const handleCommentInputChange = (event) => {
        setComment(event.target.value);
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

    const addComment = () => {
        CountryDataService
            .addComment(currentCountry.id, comment)
            .then(response => {
                currentCountry.comments.push(comment);
                countryMeta.commentsCount += 1;

                setMessage("Thanks for your comment!");
                setComment("");
                setCurrentCountry(currentCountry);
                setCountryMeta(countryMeta);
            })
            .catch(e => {
                setMessage(e.message);
            });
    };

    return (

        <div>
            {currentCountry ? (
                <>
                    <p>{message}</p>
                    <div className="edit-form">
                        <h4>Country1</h4>
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
                            className="btn btn-success"
                            onClick={updateCountry}
                        >
                            Update
                        </button>
                    </div>
                    <div>
                        <div className="add-comment-form">
                            <h4>Comments</h4>
                            <p>Count: {countryMeta.commentsCount}</p>

                            <ul>
                                {currentCountry.comments.map(function(comment, index) {
                                    return <li key={index}>
                                        {comment}
                                    </li>
                                })}
                            </ul>

                            <form>
                                <div className="form-group">
                                    <label htmlFor="comment">Comment:</label>
                                    <textarea
                                        className="form-control"
                                        id="comment"
                                        name="comment"
                                        value={comment}
                                        onChange={handleCommentInputChange}
                                    />
                                </div>
                            </form>

                            <button
                                className="btn btn-success"
                                onClick={addComment}
                            >
                                Add Comment
                            </button>
                        </div>
                    </div>
                </>
            ) : ('')}
        </div>
    );
};

export default Country;
