window.axios = require('axios/index');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-CSRF-TOKEN']     = document.head.querySelector(
    'meta[name="csrf-token"]').content;
window.axios.defaults.baseURL                            = `${window.location.origin}/prequel-api`;
