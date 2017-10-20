define([
    'uiComponent',
    'Magento_Customer/js/customer-data',
    'jquery',
    'ko',
    'underscore',
    'mage/cookies'
], function(Component, customerData, $, ko, _) {
    'use strict';

    return Component.extend({
        shoppingCartUrl: window.checkout.shoppingCartUrl,
        cart: {},

        /**
         * @override
         */
        initialize: function() {
            var self = this,
                cartData = customerData.get('cart');

            this.update(cartData());
            cartData.subscribe(function(updatedCart) {
                this.isLoading(false);
                this.update(updatedCart);
            }, this);
            $('[data-block="minicart"]').on('contentLoading', function() {
                self.isLoading(true);
            });
            if(cartData().website_id !== window.checkout.websiteId) {
                customerData.reload(['cart'], false);
            }

            return this._super();
        },
        isLoading: ko.observable(false),

        /**
         * @param {String} productType
         * @return {*|String}
         */
        getItemRenderer: function(productType) {
            return this.itemRenderer[productType] || 'defaultRenderer';
        },

        /**
         * Update mini shopping cart content.
         *
         * @param {Object} updatedCart
         * @returns void
         */
        update: function(updatedCart) {
            _.each(updatedCart, function(value, key) {
                if(!this.cart.hasOwnProperty(key)) {
                    this.cart[key] = ko.observable();
                }
                this.cart[key](value);
            }, this);
        },

        /**
         * Get cart param by name.
         * @param {String} name
         * @returns {*}
         */
        getCartParam: function(name) {
            if(!_.isUndefined(name)) {
                if(!this.cart.hasOwnProperty(name)) {
                    this.cart[name] = ko.observable();
                }
            }

            return this.cart[name]();
        },

        /**
         * Check additional sidebar
         * @param element
         * @returns {boolean}
         */
        isAdditionalSidebar: function(element) {
            return $(element).closest('.sidebar-additional').length > 0;
        },

        /**
         * @returns {string}
         */
        getCheckoutUrl: function() {
            var cart = customerData.get('cart'),
                customer = customerData.get('customer'),
                checkoutUrl = window.checkout.checkoutUrl;

            if(!customer().firstname && cart().isGuestCheckoutAllowed === false) {
                $.cookie('login_redirect', checkoutUrl);
                return window.checkout.customerLoginUrl;
            }

            return checkoutUrl;
        }
    });
});
