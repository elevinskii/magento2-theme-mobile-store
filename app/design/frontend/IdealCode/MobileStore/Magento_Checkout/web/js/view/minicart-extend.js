define([
    'jquery',
    'Magento_Checkout/js/view/minicart',
    'underscore'
], function ($, Component, _) {

    return Component.extend({

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
