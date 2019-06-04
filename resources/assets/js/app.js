require('./bootstrap');
window.Vue = require('vue');

import App from './App.vue'

// Font awesome
import {library} from "@fortawesome/fontawesome-svg-core"
import {
    faDatabase,
    faCheckCircle,
    faTable,
    faChevronCircleUp,
    faSearchPlus,
    faTools,
    faGlasses
} from '@fortawesome/free-solid-svg-icons'
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'

library.add(faDatabase, faCheckCircle, faTable, faChevronCircleUp, faSearchPlus, faTools, faGlasses)

Vue.component('font-awesome-icon', FontAwesomeIcon)

new Vue({
    el: '#sequel',
    ...App
});
