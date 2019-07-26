/**
 * Capitalise first letter of word
 */
window.capitalise = function(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
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
