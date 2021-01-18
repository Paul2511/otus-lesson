import axios from '../../../axios/index.js'
import store from '../../../../store/store.js'

import router from '@/router'

// Token Refresh
let isAlreadyFetchingAccessToken = false
let subscribers = []

function onAccessTokenFetched(access_token) {
    subscribers = subscribers.filter(callback => callback(access_token))
}

function addSubscriber(callback) {
    subscribers.push(callback)
}

export default {
    init() {
        axios.interceptors.request.use(function (config) {
            const accessToken = localStorage.getItem('accessToken') || null;
            config.headers = {};
            if (!!accessToken) {
                config.headers['Authorization'] = `Bearer ${accessToken}`;
            }

            const currentLocale = store.getters.currentLocale;
            if (!!currentLocale) {
                config.headers['Accept-Language'] = currentLocale;
            }

            return config;
        }, function (error) {
            return Promise.reject(error);
        });

        axios.interceptors.response.use(function (response) {
            return response
        }, function (error) {
            // const { config, response: { status } } = error
            const {config, response} = error
            const originalRequest = config

            // if (status === 401) {
            if (response && response.status === 401) {
                if (!isAlreadyFetchingAccessToken) {
                    isAlreadyFetchingAccessToken = true
                    store.dispatch('auth/fetchAccessToken')
                        .then((req) => {
                            isAlreadyFetchingAccessToken = true
                            localStorage.setItem('accessToken', req.data)
                            onAccessTokenFetched(req.data)
                        })
                } else {
                    if (localStorage.getItem('accessToken')) {
                        localStorage.removeItem('accessToken');
                    }
                    localStorage.removeItem('userInfo');
                    router.push('/login').catch(() => {
                    })
                }

                const retryOriginalRequest = new Promise((resolve) => {
                    addSubscriber(access_token => {
                        originalRequest.headers.Authorization = `Bearer ${access_token}`
                        resolve(axios(originalRequest))
                    })
                })
                return retryOriginalRequest
            }
            return Promise.reject(error)
        })
    },

    login(email, pwd) {
        return axios.post('/api/auth/login', {
            email,
            password: pwd
        })
    },
    registerUser(name, email, pwd) {
        return axios.post('/api/auth/register', {
            displayName: name,
            email,
            password: pwd
        })
    },
    refreshToken() {
        return axios.post('/api/auth/refresh', {accessToken: localStorage.getItem('accessToken')})
    }
}