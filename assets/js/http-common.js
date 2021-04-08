import axios from "axios";
import AuthService from "./services/AuthService";

//TODO store these tokens in cookie
const accessToken = localStorage.getItem('token');
const refreshToken = localStorage.getItem('refreshToken');

const headers = {
    "Content-type": "application/json"
};

if (accessToken) {
    headers.Authorization = `Bearer ${accessToken}`;
}

const axiosInstance = axios.create({
    baseURL: "https://localhost:8000/api",
    headers: headers
});

axiosInstance.interceptors.response.use(
    (response) => {
        console.log(response);
        return new Promise((resolve, reject) => {
            resolve(response);
        });
    },
    async (error) => {
        if (!error.response) {
            return new Promise((resolve, reject) => {
                reject(error);
            });
        }

        const originalRequest = error.config;

        if (error.response.status === 401 && !originalRequest._retry) {
            originalRequest._retry = true;
            let accessToken = null;

            if (refreshToken) {
                await AuthService
                    .refreshAccessToken(refreshToken)
                    .then((res) => {
                        accessToken = res.data.token;

                        localStorage.setItem('token', res.data.token);
                        localStorage.setItem('refreshToken', res.data.refreshToken);
                    })
                    .catch(e => {
                        localStorage.removeItem('token');
                        localStorage.removeItem('refreshToken');
                    });
            } else {
                await AuthService
                    .accessToken()
                    .then((res) => {
                        accessToken = res.data.token;

                        localStorage.setItem('token', res.data.token);
                        localStorage.setItem('refreshToken', res.data.refreshToken);
                    })
                    .catch(e => {
                        console.log(e);
                    });
            }

            if (accessToken) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${accessToken}`;
            }

            return axiosInstance(originalRequest);
        } else {
            return new Promise((resolve, reject) => {
                reject(error);
            });
        }
    }
);

export default axiosInstance;