import Vue from "vue";

// eslint-disable-next-line no-undef
require("./bootstrap/bootstrap");

// eslint-disable-next-line no-undef
window.Vue = require("vue");

import Prequel from "./components/Pages/Prequel.vue";

new Vue({
    el: "#prequel",
    ...Prequel,
});
