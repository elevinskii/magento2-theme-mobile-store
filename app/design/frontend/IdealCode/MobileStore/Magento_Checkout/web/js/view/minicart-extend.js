define([
    'Magento_Checkout/js/view/minicart',
], function (Component) {

    return Component.extend({
        /**
         * Get minicart label in Russian locale.
         * @param {String} count
         * @param titles
         * @returns {*}
         */
        getLabel: function(count, titles) {
            /** @see https://gist.github.com/realmyst/1262561 */
            var cases = [2, 0, 1, 1, 1, 2];
            return titles[ (count%100>4 && count%100<20)? 2 : cases[(count%10<5)?count%10:5] ];
        }
    });
});
