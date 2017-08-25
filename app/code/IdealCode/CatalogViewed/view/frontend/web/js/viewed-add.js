define([
    'jquery',
], function($) {

    ViewedAdd = {
        /**
         * @param options
         * @constructor
         */
        'IdealCode_CatalogViewed/js/viewed-add': function (options) {
            this.options = options;
            this._ajax();
        },

        _ajax: function() {
            var formKey = $('input[name="form_key"]').val();
            if (formKey) {
                this.options.data.form_key = formKey;
            }

            $.ajax({
                type: 'post',
                url: this.options.action,
                data: this.options.data
            });
        }
    };

    return ViewedAdd;
});
