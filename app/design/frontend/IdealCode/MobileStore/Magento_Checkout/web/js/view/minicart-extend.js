define([
    'Magento_Checkout/js/view/minicart',
    'underscore'
], function (Component, _) {

    return Component.extend({
        /**
         * Get minicart label.
         * @param titles
         * @param locale
         * @returns {*}
         */
        getLabel: function(titles, locale = '') {
            var count = this.getCartParam('summary_count');

            if(!_.isUndefined(count)) {
                if(locale == 'ru') {
                    /** @see https://gist.github.com/realmyst/1262561 */
                    var cases = [2, 0, 1, 1, 1, 2];
                    return titles[(count % 100 > 4 && count % 100 < 20) ? 2 : cases[(count % 10 < 5) ? count % 10 : 5]];
                } else {
                    return titles[count == 1 ? 0 : 1];
                }
            }
        }
    });
});
