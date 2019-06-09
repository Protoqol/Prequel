require('./bootstrap');
window.Vue = require('vue');

import App from './App.vue';

import {library} from '@fortawesome/fontawesome-svg-core';
import {
    faAsterisk,
    faChevronCircleUp,
    faDatabase,
    faGlasses,
    faSearchPlus,
    faTable,
    faTools,
} from '@fortawesome/free-solid-svg-icons';
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';
import hljs from 'highlight.js';
import 'highlight.js/styles/github.css';
import javascript from 'highlight.js/lib/languages/javascript';
import sql from 'highlight.js/lib/languages/sql';

hljs.registerLanguage('javascript', javascript);
hljs.registerLanguage('sql', sql);

library.add(faDatabase, faTable, faChevronCircleUp, faSearchPlus, faTools, faGlasses, faAsterisk);

Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.directive('highlightjs', {
    deep: true,
    bind: function (el, binding) {
        // on first bind, highlight all targets
        let targets = el.querySelectorAll('code');
        targets.forEach((target) => {
            // if a value is directly assigned to the directive, use this
            // instead of the element content.
            if (binding.value) {
                target.textContent = binding.value;
            }
            hljs.highlightBlock(target);
        });
    },
    componentUpdated: function (el, binding) {
        // after an update, re-fill the content and then highlight
        let targets = el.querySelectorAll('code');
        targets.forEach((target) => {
            if (binding.value) {
                target.textContent = binding.value;
                hljs.highlightBlock(target);
            }
        });
    },
});

new Vue({
    el: '#prequel',
    ...App,
});
