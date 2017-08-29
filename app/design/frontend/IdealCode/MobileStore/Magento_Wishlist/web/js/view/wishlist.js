define([
    'uiComponent',
    'Magento_Customer/js/customer-data'
], function (Component, customerData) {

    return Component.extend({

        /**
         * Init of UI component
         */
        initialize: function () {
            this._super();
            this.wishlist = customerData.get('wishlist');
        },

        /**
         * Check product in wishlist
         * @param id
         */
        productInWishlist: function (id) {
            if(this.wishlist().extra) {
                for (var key in this.wishlist().extra) {
                    if (this.wishlist().extra[key].id == id) {
                        return this.wishlist().extra[key];
                    }
                }
            }
            return false;
        }
    });
});
