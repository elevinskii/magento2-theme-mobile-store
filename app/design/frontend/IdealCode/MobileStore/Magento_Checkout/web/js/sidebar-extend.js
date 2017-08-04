define([
    'jquery',
    'Magento_Checkout/js/sidebar',
], function ($) {

    $.widget('idealCode.sidebar', $.mage.sidebar, {
        /**
         * Create sidebar.
         * @private
         */
        _create: function () {
            var self = this,
                events = {};

            this._initContent();
            this._off(self.element, 'click');

            events['click ' + this.options.button.remove] =  function (event) {
                self._removeItem($(event.currentTarget));
                return false;
            };

            this._on(this.element, events);
        }
    });

    return $.idealCode.sidebar;
});
