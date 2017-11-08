define([
    'jquery',
    'uiComponent',
    'Magento_Customer/js/customer-data'
], function($, Component, customerData) {
    'use strict';

    return Component.extend({
        initialize: function() {
            this._super();
            this.compareProducts = customerData.get('compare-products');

            this.compareProducts.subscribe(function() {
                $('.block.compare').trigger('processStop');
            });
        },

        /**
         * Check product in compare
         * @param id
         */
        productInCompare: function(id) {
            if(this.compareProducts().items) {
                for(var key in this.compareProducts().items) {
                    if(this.compareProducts().items[key].id == id) {
                        return this.compareProducts().items[key];
                    }
                }
            }
            return false;
        }
    });
});
