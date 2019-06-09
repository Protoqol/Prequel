window._     = require('lodash');
window.axios = require('axios/index');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-CSRF-TOKEN']     = document.head.querySelector('meta[name="csrf-token"]').content;
window.axios.defaults.baseURL                            = `${window.location.href}/prequel-api`;

/**
 * Capitalise first letter of word
 */
window.capitalise = function (str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
};

/**
 *  Might do real-time database updating in the future. Let people F5 for now :^).
 *
 *  import Echo from 'laravel-echo'
 *
 *  window.Pusher = require('pusher-js');
 *
 *  window.Echo = new Echo({
 *      broadcaster: 'pusher',
 *      key: process.env.MIX_PUSHER_APP_KEY,
 *      cluster: process.env.MIX_PUSHER_APP_CLUSTER,
 *      encrypted: true
 *  });
 */
