window._ = require('lodash');

/**
 * Axios
 */
window.axios = require('axios/index');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-CSRF-TOKEN']     = document.head.querySelector(
    'meta[name="csrf-token"]').content;
window.axios.defaults.baseURL                            = `${window.location.origin}/prequel/prequel-api`;

/**
 * Fontawesome
 */
import Vue               from 'vue';
import {library}         from '@fortawesome/fontawesome-svg-core';
import {
  faAsterisk,
  faChevronCircleUp,
  faDatabase,
  faGlasses,
  faSearchPlus,
  faTable,
  faTools,
}                        from '@fortawesome/free-solid-svg-icons';
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';

library.add(faDatabase, faTable, faChevronCircleUp, faSearchPlus, faTools,
    faGlasses, faAsterisk);

Vue.component('font-awesome-icon', FontAwesomeIcon);

/**
 * Highlight.js
 */
import highlight         from 'highlight.js';
import 'highlight.js/styles/github.css';
import sql               from 'highlight.js/lib/languages/sql';

highlight.registerLanguage('sql', sql);

Vue.directive('highlightjs', {
  deep            : true,
  bind            : function(el, binding) {
    let targets = el.querySelectorAll('code');
    targets.forEach((target) => {
      if (binding.value) {
        target.textContent = binding.value;
      }
      highlight.highlightBlock(target);
    });
  },
  componentUpdated: function(el, binding) {
    let targets = el.querySelectorAll('code');
    targets.forEach((target) => {
      if (binding.value) {
        target.textContent = binding.value;
        highlight.highlightBlock(target);
      }
    });
  },
});

/**
 * Capitalise first letter of word
 */
window.capitalise = function(str) {
  return str.charAt(0).toUpperCase() + str.slice(1);
};

/**
 *  Might do real-time database updating in the future. Let people F5 for now
 * :^).
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
