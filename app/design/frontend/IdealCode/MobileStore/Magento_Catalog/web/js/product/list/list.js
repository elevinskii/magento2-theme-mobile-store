define([
    'jquery',
    'jquery/ui'
], function($) {
    'use strict';

    $.widget('idealCode.productList', {

        /**
         * Init widget
         * @private
         */
        _create: function() {
            this._handleImage();
        },

        /**
         * @private
         */
        _handleImage: function() {
            this.element.find('.image').hover(
                function() {
                    $(this).find('img')
                        .first().hide().end()
                        .last().show();
                },
                function() {
                    $(this).find('img')
                        .first().show().end()
                        .last().hide();
                }
            );
        }
    });

    return $.idealCode.productList;
});
