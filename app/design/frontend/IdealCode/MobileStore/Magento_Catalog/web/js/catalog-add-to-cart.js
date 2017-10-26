define([
    'jquery',
    'mage/translate',
    'jquery/ui'
], function($, $t) {
    'use strict';

    $.widget('mage.catalogAddToCart', {

        options: {
            processStart: null,
            processStop: null,
            minicartSelector: '[data-block="minicart"]',
            messagesSelector: '[data-placeholder="messages"]',
            productStatusSelector: '.stock.available',
            addToCartButtonSelector: '.action.tocart',
            addToCartButtonDisabledClass: 'disabled',
            addToCartButtonTextWhileAdding: '',
            addToCartButtonTextDefault: ''
        },

        _create: function() {
            this._bindSubmit();
        },

        _bindSubmit: function() {
            var self = this;
            this.element.on('submit', function(e) {
                e.preventDefault();
                self.ajaxSubmit($(this));
            });
        },

        isLoaderEnabled: function() {
            return this.options.processStart && this.options.processStop;
        },

        ajaxSubmit: function(form) {
            var self = this;
            $(self.options.minicartSelector).trigger('contentLoading');
            self.disableAddToCartButton(form);

            var data = form.serialize();
            data += (data.length > 0 ? '&' : '') + 'form_key=' + $('input[name="form_key"]').val();

            $.ajax({
                url: form.attr('action'),
                data: data,
                type: 'post',
                dataType: 'json',
                beforeSend: function() {
                    if(self.isLoaderEnabled()) {
                        $('body').trigger(self.options.processStart);
                    }
                },
                success: function(res) {
                    if(self.isLoaderEnabled()) {
                        $('body').trigger(self.options.processStop);
                    }

                    if(res.backUrl) {
                        window.location = res.backUrl;
                        return;
                    }
                    if(res.messages) {
                        $(self.options.messagesSelector).html(res.messages);
                    }
                    if(res.minicart) {
                        $(self.options.minicartSelector).replaceWith(res.minicart);
                        $(self.options.minicartSelector).trigger('contentUpdated');
                    }
                    if(res.product && res.product.statusText) {
                        $(self.options.productStatusSelector)
                            .removeClass('available')
                            .addClass('unavailable')
                            .find('span')
                            .html(res.product.statusText);
                    }
                    self.enableAddToCartButton(form);
                }
            });
        },

        disableAddToCartButton: function(form) {
            var addToCartButtonTextWhileAdding = this.options.addToCartButtonTextWhileAdding || $t('Adding...');
            $(form).find(this.options.addToCartButtonSelector)
                .addClass(this.options.addToCartButtonDisabledClass)
                .text(addToCartButtonTextWhileAdding)
                .attr('title', addToCartButtonTextWhileAdding);
        },

        enableAddToCartButton: function(form) {
            var self = this;

            setTimeout(function() {
                var addToCartButtonTextDefault = self.options.addToCartButtonTextDefault || $t('Add to Cart');
                $(form).find(self.options.addToCartButtonSelector)
                    .removeClass(self.options.addToCartButtonDisabledClass)
                    .text(addToCartButtonTextDefault)
                    .attr('title', addToCartButtonTextDefault);
            }, 1000);
        }
    });

    return $.mage.catalogAddToCart;
});
