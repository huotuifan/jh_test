define([
    'common/utils',
    'jquery',
    'jqueryui/dialog'
], function (utils, $) {

    $('#SettingsPopup').dialog({
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

    $('#LinkSettings').click(function (event) {
        $('#ErrorMessage').hide();
        $('#SettingsPopup').dialog('option', 'width', getWidth());
        $('#SettingsPopup').dialog('open');
        event.preventDefault();
    });

    $('#SettingsForm').submit(function (event) {
        $('#ErrorMessage').empty().hide();
        utils.formAction('common.settings', this, function () {
            window.location.reload();
        });
        event.preventDefault();
    });

    $('#ButtonSettingsCancel').click(function() {
        $('#SettingsPopup').dialog('close');
    })
});
