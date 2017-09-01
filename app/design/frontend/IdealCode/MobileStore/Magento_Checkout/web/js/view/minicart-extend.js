define([
    'jquery',
    'Magento_Checkout/js/view/minicart',
    'underscore'
], function ($, Component, _) {

    return Component.extend({

        /**
         * Get minicart label.
         * @param locale
         * @returns {*}
         */
        getLabel: function(locale = '') {
            var count = this.getCartParam('summary_count'),
                titles = [$.mage.__('item'), $.mage.__('items'), $.mage.__('items2')];

            if(!_.isUndefined(count)) {
                if(locale == 'ru_RU') {
                    /** @see https://gist.github.com/realmyst/1262561 */
                    var cases = [2, 0, 1, 1, 1, 2];
                    return count+' '+titles[(count % 100 > 4 && count % 100 < 20) ? 2 : cases[(count % 10 < 5) ? count % 10 : 5]];
                } else {
                    return count+' '+titles[count == 1 ? 0 : 1];
                }
            }
        },

        /**
         * Check additional sidebar
         * @param element
         * @returns {boolean}
         */
        isAdditionalSidebar: function(element) {
            return $(element).closest('.sidebar-additional').length > 0;
        }
    });
});
