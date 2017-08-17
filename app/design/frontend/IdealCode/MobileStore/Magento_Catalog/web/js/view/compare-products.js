define([
    'uiComponent',
    'Magento_Customer/js/customer-data'
], function (Component, customerData) {
    'use strict';

    return Component.extend({
        initialize: function () {
            this._super();
            this.compareProducts = customerData.get('compare-products');
        },

        /**
         * Check product in compare
         * @param id
         */
        productInCompare: function(id) {
            if(this.compareProducts().items) {
                for (var key in this.compareProducts().items) {
                    if (this.compareProducts().items[key].id == id) {
                        return this.compareProducts().items[key];
                    }
                }
            }
            return false;
        }
    });
});
