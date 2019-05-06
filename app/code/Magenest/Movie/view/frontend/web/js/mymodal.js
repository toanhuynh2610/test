define([
    "jquery",
    "Magento_Ui/js/modal/modal"
], function($, modal){
    var options = {
        type: 'popup',
        responsive: true,
        innerScroll: true,
        title: "Login Modal", //write your popup title
        buttons: [
            {
                text: $.mage.__('Close'),
                class: 'button',
                click: function () {
                    this.closeModal();
                }
            }
        ]
    };
    var popup = modal(options, $('#popup-mpdal'));
    $("#open-modal").on('click',function(){

        $("#popup-mpdal").modal("openModal");

    });
});