define([
    'jquery',
    'jquery/ui',
    'Magento_Customer/js/customer-data'
], function($, jqueryUi, customerData) {

    $.widget('idealCode.dataAjax', {

        /**
         * Init widget
         * @private
         */
        _create: function() {
            this._bind();

            customerData.get('messages').subscribe(function() {
                $('.messages').trigger('processStop');
            });
        },

        /**
         * Bind events for links and forms
         * @private
         */
        _bind: function() {
            var self = this,
                events = {};

            events['submit form[data-ajax]'] = function(event) {
                var data = {};
                $(event.target).serializeArray().forEach(function(entry) {
                    data[entry.name] = entry.value;
                });

                var ajax = $(event.target).data('ajax');
                ajax.data = data;

                self._ajax($(event.target), ajax);
                return false;
            };
            events['click a[data-ajax]'] = function(event) {
                self._ajax($(event.target), $(event.target).data('ajax'));
                return false;
            };
            this._on(this.element, events);
        },

        /**
         * Add form key to data request
         * @param data
         * @returns {*}
         * @private
         */
        _addFormKey: function(data) {
            var formKey = $('input[name="form_key"]').val();
            if (formKey) {
                data.form_key = formKey;
            }

            return data;
        },

        /**
         * Preloader implementation
         * @param elem
         * @private
         */
        _preloaderShow: function(elem) {
            if(!elem.is('form')) {
                var msg = $.mage.__('Loading..');
                if(msg && $.trim(elem.text())) {
                    elem.attr('title', msg).text(msg);
                }
            }
        },

        /**
         * Processing ajax request
         * @param elem
         * @param ajax
         * @returns {boolean}
         * @private
         */
        _ajax: function(elem, ajax) {
            if(elem.is('.disabled')) {
                return false;
            }
            elem.addClass('disabled');
            this._preloaderShow(elem);

            $.ajax({
                method: 'post',
                url: ajax.action,
                data: this._addFormKey(ajax.data),
                beforeSend: function() {
                    elem.trigger('processStart');
                },
                success: function(response) {
                    elem.removeClass('disabled');
                    if(response.success && ajax.reload) {
                        location.reload();
                    }
                }
            });
        }
    });

    return $.idealCode.dataAjax;
});