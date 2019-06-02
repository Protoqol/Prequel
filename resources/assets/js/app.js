require('./bootstrap');
window.Vue = require('vue');

import App from './App.vue'
import {library} from "@fortawesome/fontawesome-svg-core"
import {faDatabase, faCheckCircle} from '@fortawesome/free-solid-svg-icons'
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'

library.add(faDatabase, faCheckCircle)

Vue.component('font-awesome-icon', FontAwesomeIcon)

new Vue({
    el: '#sequel',
    ...App
});
