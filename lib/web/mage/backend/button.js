/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

(function (factory) {
    'use strict';

    if (typeof define === 'function' && define.amd) {
        define([
            'jquery',
            'jquery/ui'
        ], factory);
    } else {
        factory(jQuery);
    }
}(function ($) {
    'use strict';

    $.widget('ui.button', $.ui.button, {
        options: {
            eventData: {},
            waitTillResolved: true
        },

        /**
         * Button creation.
         * @protected
         */
        _create: function () {
            if (this.options.event) {
                this.options.target = this.options.target || this.element;
                this._bind();
            }

            this._super();
        },

        /**
         * Bind handler on button click.
         * @protected
         */
        _bind: function () {
            this.element
<<<<<<< HEAD
                .off('click.button')
                .on('click.button', $.proxy(this._click, this));
=======
                .off('Magenest.Movie.view.adminhtml.templates.system.config.button')
                .on('Magenest.Movie.view.adminhtml.templates.system.config.button', $.proxy(this._click, this));
>>>>>>> 42eb8115f477a184a19a3c230f15d7e1ff27e6cf
        },

        /**
         * Button click handler.
         * @protected
         */
        _click: function () {
            var options = this.options;

            $(options.target).trigger(options.event, [options.eventData]);
        }
    });

    return $.ui.button;
}));
