import Vue                 from "vue";
import { library }         from "@fortawesome/fontawesome-svg-core";
import {
    faAdjust,
    faAsterisk,
    faChevronCircleUp,
    faDatabase,
    faGlasses,
    faSearchPlus,
    faTable,
    faTools,
    faEye,
    faWrench,
    faRunning,
    faExclamationTriangle,
    faPlus,
    faSave,
    faIndustry,
    faBirthdayCake,
    faSeedling, faStream, faHatWizard, faSyncAlt, faSync,
}                          from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

library.add(
    faDatabase,
    faTable,
    faChevronCircleUp,
    faSearchPlus,
    faTools,
    faGlasses,
    faAsterisk,
    faAdjust,
    faExclamationTriangle,
    faEye,
    faWrench,
    faRunning,
    faPlus,
    faSave,
    faIndustry,
    faBirthdayCake,
    faSeedling,
    faStream,
    faHatWizard,
    faSyncAlt,
    faSync,
);

Vue.component("font-awesome-icon", FontAwesomeIcon);
