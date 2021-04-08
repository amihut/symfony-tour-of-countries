import http from '../../http-common';

const getAll = () => {
    return http.get('/locations/countries');
};

const update = (id, data) => {
    return http.put(`/locations/countries/id/${id}`, data);
};

const findById = (id) => {
    return http.get(`/locations/countries/id/${id}`);
};

const findByCode = (code) => {
    return http.get(`/locations/countries/code/${code}`);
};

const addComment = (id, comment) => {
    return http.post(`/locations/countries/comments`, {
        id: id,
        comment: comment
    });
};

const deleteCountry = (id) => {
    return http.delete(`/locations/countries/id/${id}`);
};

export default {
    findByCode,
    findById,
    getAll,
    update,
    addComment,
    deleteCountry
};