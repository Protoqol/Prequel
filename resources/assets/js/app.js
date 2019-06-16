window.Vue = require('vue');
require('./bootstrap');

/**
 * Main component
 */
import App from './App.vue';

/**
 * Vue instance
 */
new Vue({
  el: '#prequel',
  ...App,
});
