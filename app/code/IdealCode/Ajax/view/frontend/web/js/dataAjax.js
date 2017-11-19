define([
    'jquery',
    'jquery/ui'
], function($, jqueryUi) {

    $.widget('idealCode.dataAjax', {

        /**
         * Init widget
         * @private
         */
        _create: function() {
            this._bind();
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
                ajax.action = $(event.target).attr('action');

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
                    var loader = ajax.loader ? $(ajax.loader) : elem;
                    loader.trigger('processStart');
                },
                success: function(response) {
                    elem.removeClass('disabled');
                    if(response.success) {
                        if(ajax['load-page']) {
                            window.location = ajax['load-page'];
                        } else if(ajax['data']['reload-block']) {
                            var insertTo = ajax['data']['reload-block']['insert-to'];
                            $(insertTo).replaceWith(response.block);
                            $(insertTo).trigger('contentUpdated').applyBindings();
                        }
                    }

                    if(elem.is('form')) {
                        elem.trigger('processStop');

                        if(response.message) {
                            $('[data-placeholder="messages"]').html('');
                            elem.find('[data-placeholder="messages"]')
                                .html(response.message)
                                .removeClass('success')
                                .removeClass('errors')
                                .addClass(response.success ? 'success' : 'errors');
                        }
                    }
                }
            });
        }
    });

    return $.idealCode.dataAjax;
});
