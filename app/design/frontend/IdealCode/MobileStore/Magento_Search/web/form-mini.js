define([
    'jquery',
    'underscore',
    'jquery/ui'
], function ($, _) {
    'use strict';

    $.widget('mage.quickSearch', {
        options: {
            minSearchLength: 2,
            template:
                '<li>' +
                    '<a href="<%- url %>" title="<%- name %>">' +
                        '<img src="<%- image.src %>"' +
                            'alt="<%- image.alt %>"' +
                            'width="<%- image.width %>"' +
                            'height="<%- image.height %>"' +
                        '>' +
                        '<div class="option"><%- name %></div>' +
                        '<% if(price != final_price) { %>' +
                            '<%- final_price %>' +
                            '<span class="old-price"><%- price %></span>' +
                        '<% } else { %>' +
                            '<%- price %>' +
                        '<% } %>' +
                    '</a>' +
                '</li>'
        },

        /**
         * Constructor of the widget
         * @private
         */
        _create: function() {
            this.autoComplete = $(this.options.suggest);

            _.bindAll(this, '_onPropertyChange', '_onKeyDown', '_onSubmit', '_onClose');
            this.element.on('input propertychange', this._onPropertyChange);
            this.element.on('keydown', this._onKeyDown);
            this.element.closest('form').on('submit', this._onSubmit);
            $(document).on('click', this._onClose);
        },

        /**
         * Open suggest block by search input change
         * @private
         */
        _onPropertyChange: function() {
            var input = this.element,
                render = _.template(this.options.template),
                dropdown = $('<ul />');

            if(input.val().length >= parseInt(this.options.minSearchLength)) {
                $.get(this.options.url, {q: input.val()}, function(data) {
                    $.each(data, function(index, element) {
                        var element = $(render(element));

                        element.on('mouseenter', function() {
                            $(this).addClass('selected').siblings().removeClass('selected');
                            input.val($(this).find('.option').text());
                        });
                        dropdown.append(element);
                    });
                });

                this.autoComplete.html(dropdown);
            }
        },

        /**
         * @param e
         * @returns {boolean}
         * @private
         */
        _onKeyDown: function(e) {
            var keyCode = e.keyCode || e.which,
                responseList = this.autoComplete.find('li'),
                selected = responseList.filter('.selected');

            if(keyCode == $.ui.keyCode.DOWN || keyCode == $.ui.keyCode.UP) {
                var nextSelected = keyCode == $.ui.keyCode.DOWN ?
                    (selected.next().length ? selected.next() : responseList.first()) :
                    (selected.prev().length ? selected.prev() : responseList.last());
                nextSelected.trigger('mouseenter');

                return false;
            }
        },

        /**
         * Submit search form
         * @returns {boolean}
         * @private
         */
        _onSubmit: function() {
            var selected = this.autoComplete.find('li.selected');

            if(selected.length > 0) {
                location.href = selected.find('a').attr('href');
                return false;
            }
        },

        /**
         * Close suggest block
         * @param e
         * @private
         */
        _onClose: function(e) {
            if($(e.target).closest(this.element.closest('form')).length <= 0) {
                this.autoComplete.html('');
            }
        }
    });

    return $.mage.quickSearch;
});
