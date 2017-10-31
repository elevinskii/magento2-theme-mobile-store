define([
    'jquery',
    'jquery/ui'
], function($) {

    $.widget('idealCode.dataAjax', {

        /**
         * Init widget
         * @private
         */
        _create: function() {
            this._bind();
        },

        /**
         * Bind events for links
         * @private
         */
        _bind: function() {
            var self = this,
                events = {};

            events['click [data-ajax]'] = function (event) {
                self._ajax($(event.target), $(event.target).data('ajax'));
                return false;
            };
            this._on(this.element, events);
        },

        /**
         * Processing ajax request
         * @param elem
         * @param params
         * @returns {boolean}
         * @private
         */
        _ajax: function(elem, params) {
            if(elem.is('.disabled')) {
                return false;
            }
            elem.addClass('disabled');

            var formKey = $('input[name="form_key"]').val();
            if (formKey) {
                params.data.form_key = formKey;
            }

            var msg = $.mage.__('Loading..');
            if(msg && $.trim(elem.text())) {
                elem.attr('title', msg).text(msg);
            }

            $.ajax({
                type: 'post',
                url: params.action,
                data: params.data
            });
        }
    });

    return $.idealCode.dataAjax;
});
