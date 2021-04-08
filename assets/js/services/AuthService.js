import http from '../http-common';

const refreshAccessToken = (token) => {
    return http.post('/token/refresh', {refresh_token: token});
};

const accessToken = () => {
    // use encryption algoritms in prod!
    return http.post('/login_check', {
        username: 'admin@admin.com',
        password: '000000'
    });
};

export default {
    accessToken,
    refreshAccessToken
};