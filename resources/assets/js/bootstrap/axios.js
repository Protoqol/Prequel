import Request from 'axios-request-handler';

window.axios = require('axios/index');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content;

if (window.Prequel.env.hasOwnProperty('baseUrl')) {
    window.axios.defaults.baseURL = `${window.Prequel.env.baseUrl ? window.Prequel.env.baseUrl : window.location.origin}/prequel-api`;
}

// Abstracted method to poll API.
function HTTPoll (url, time = 1500, method = 'get', options = {}) {
    let validUrl = url.charAt(0) !== '/' ? window.axios.defaults.baseURL + '/' + url : window.axios.defaults.baseURL + url;

    let request = new Request(validUrl);
    let response = {};

    if (method === 'get') {
        request.poll(time).get(res => {
            response = res.data;
        }, options);
    }

    if (method === 'post') {
        request.poll(time).post(res => {
            response = res.data;
        }, options);
    }

    return response;
}

// Asynchronous abstracted method to poll API.
async function HTTPollAsync (url, time = 1500, method = 'get', options = {}) {
    let validUrl = url.charAt(0) !== '/' ? window.axios.defaults.baseURL + '/' + url : window.axios.defaults.baseURL + url;

    let request = new Request(validUrl);
    let response = {};

    if (method === 'get') {
        await request.poll(time).get(res => {
            return res;
        }, options);
    }

    if (method === 'post') {
        await request.poll(time).post(res => {
            return res;
        }, options);
    }
}

window.HTTPoll = HTTPoll;
window.HTTPollAsync = HTTPollAsync;
