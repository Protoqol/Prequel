import Prequel from "./components/Pages/Prequel.vue";
import Vue     from "vue";

require("./bootstrap/bootstrap");

window.Vue = require("vue");

window.Prism = window.Prism || {};
window.Prism.manual = true;

new Vue({
    el: "#prequel",
    ...Prequel,
});
