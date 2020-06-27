require('./bootstrap/bootstrap');

window.Vue = require('vue');

import Prequel from './components/Pages/Prequel.vue';

new Vue({
    el: '#prequel',
    ...Prequel,
});
