define([
    'common/utils',
    'jquery',
    'jqueryui/dialog'
], function (utils, $) {

    $('#LoginPopup').dialog({
        draggable: false,
        autoOpen: false,
        modal: true,
        height: 260,
        resizable: false,
        position: 'center',
        open: function (event, ui) {
        },
        close: function (event, ui) {
        }
    });

    $('#RegPopup').dialog({
        draggable: false,
        autoOpen: false,
        modal: true,
        height: 300,
        resizable: false,
        position: 'center',
        open: function (event, ui) {
        },
        close: function (event, ui) {
        }
    });

    function getWidth() {
        return $(window).width() > 480 ? 400 : '90%';
    }

    $('#LinkLogin').click(function (event) {
        $('#ErrorMessage').hide();
        $('#LoginPopup').dialog('option', 'width', getWidth());
        $('#LoginPopup').dialog('open');
        event.preventDefault();
    });

    $('#LinkRegister').click(function (event) {
        $('#ErrorMessage').hide();
        $('#RegPopup').dialog('option', 'width', getWidth());
        $('#RegPopup').dialog('open');
        event.preventDefault();
    });

    $('#LoginForm').submit(function (event) {
        utils.formAction('common.login', this);
        event.preventDefault();
    });
       
    $('#LogOutForm').submit(function (event) {
        utils.formAction('common.logout', this);
        event.preventDefault();
    });


    $('#RegForm').submit(function (event) {
        $('#ErrorMessage').empty().hide();
        utils.formAction('common.reg', this);
        event.preventDefault();
    });
});
