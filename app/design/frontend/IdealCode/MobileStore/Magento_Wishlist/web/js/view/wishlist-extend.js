define([
    'Magento_Wishlist/js/view/wishlist'
], function (Component) {

    return Component.extend({
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
