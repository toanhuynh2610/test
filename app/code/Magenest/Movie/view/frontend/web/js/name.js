define(['ko', 'uiComponent','Magento_Ui/js/modal/alert','jquery'], function(ko, Component, alert, $) {
    'use strict';
    return Component.extend({
        defaults: {
            firstname: ko.observable(),
            lastname: ko.observable(),
            fullname: ko.observable(),
            template: 'Magenest_Movie/name'
        },
        initialize: function() {
            this._super();
        },
        initObservable: function(){
            this._super()
                .observe(['firstname', 'lastname','fullname']);
            return this;
        },
        onClick: function()
        {
            if(/^[a-zA-Z ]+$/.test( this.firstname()) && /^[a-zA-Z ]+$/.test( this.lastname())){
                this.fullname(this.firstname().charAt(0).toUpperCase() + this.firstname().slice(1)+' '+this.lastname().charAt(0).toUpperCase() + this.lastname().slice(1));
            }
            else{
                alert({
                    title: $.mage.__('Opps'),
                    content: $.mage.__('The name contains special characters'),
                    actions: {
                        always: function(){}
                    }
                });
            }
        },
        standardize: function()
        {
            if(/^[a-zA-Z ]+$/.test( this.firstname()) && /^[a-zA-Z ]+$/.test( this.lastname())){
                this.firstname(this.firstname().charAt(0).toUpperCase() + this.firstname().slice(1));
                this.lastname(this.lastname().charAt(0).toUpperCase() + this.lastname().slice(1));
            }
            else{
                alert({
                    title: $.mage.__('Opps'),
                    content: $.mage.__('The name contains special characters'),
                    actions: {
                        always: function(){}
                    }
                });
            }
        }
    });
});