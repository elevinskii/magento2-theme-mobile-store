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
            this.element.undelegate(this.options.button.remove, 'click');

            events['click ' + this.options.button.remove] =  function (event) {
                self._removeItem($(event.currentTarget));
                return false;
            };

            this._on(this.element, events);
        }
    });

    return $.idealCode.sidebar;
});
