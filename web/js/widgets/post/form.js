define([
    'common/utils',
    'common/resize',
    'jquery'
], function (utils, resize, $) {

    return {
        init: function (options) {

            if (options.resize) {
                $('#' + options.text).autoResize({
                    extraSpace: 16,
                    animate: false,
                    maxHeight: 320
                });
            }

            $('#' + options.form).submit(function (event) {

                utils.formAction(
                    options.action,
                    this,
                    function (result) {
                        if (result.isOk()) {
                            if (result['post_uuid']) {
                                window.location = '/posts/' + result['post_uuid'];
                            } else {
                                window.location.reload();
                            }
                        }
                    }
                );

                event.preventDefault();

            });

        }
    }
});