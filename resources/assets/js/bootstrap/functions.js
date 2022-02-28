import Vue from 'vue';

/**
 * Capitalise first letter of word
 *
 * @param str string
 * @returns {string}
 */
window.capitalise = function (str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
};

/**
 * Enhance readability.
 *
 * @param str
 * @returns {string}
 */
window.prettifyName = function (str) {
    let words    = str.split(/[!@#$%^&*(),.?":{}|<>_-]/);
    let readable = "";

    for (let i = 0; i < words.length; i++) {
        readable += capitalise(words[i].toLowerCase());

        if (i !== (words.length - 1)) {
            readable += " ";
        }
    }

    return readable;
};

/**
 * Handle translations.
 *
 * @param string
 * @param args
 * @returns {*}
 */
Vue.prototype.trans = (string, args) => {
    let value = _.get(window.Prequel.i18n, string);

    _.eachRight(args, (paramVal, paramKey) => {
        value = _.replace(value, `:${paramKey}`, paramVal);
    });
    return value;
};

