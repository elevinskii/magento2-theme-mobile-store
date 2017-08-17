define([
    'jquery',
    'Magento_Customer/js/customer-data',
    'jquery/ui',
], function($, customerData) {
    "use strict";

    $.widget('idealCode.addto', {
        _create: function() {
            this._bind();
        },

        _bind: function() {
            var self = this,
                events = {};

            events['click [data-ajax]'] = function (event) {
                self._ajax($(event.target), $(event.target).data('ajax'));
                return false;
            };
            this._on(this.element, events);
        },

        _ajax: function(elem, params) {
            if(elem.is('.disabled')) {
                return false;
            }

            var formKey = $('input[name="form_key"]').val();
            if (formKey) {
                params.data.form_key = formKey;
            }

            elem.addClass('disabled').text($.mage.__('Loading..'));

            $.ajax({
                type: 'post',
                url: params.action,
                data: params.data
            });
        },
    });

    return $.idealCode.addto;
});
