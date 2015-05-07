define([
    'jquery'
], function ($) {

    $('.f-message').click(function () {
        $(this).fadeOut();
    });

    var i = 0;

    $(".f-loading").ajaxStart(function () {
        i++;
        $(this).show();
    }).ajaxComplete(
        function () {
            if (i > 0) {
                i--;
                if (i == 0) {
                    $(this).hide();
                }
            }
        }
    );

});