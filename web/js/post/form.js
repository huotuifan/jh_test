define([
    'common/utils',
    'common/resize',
    'jquery',
    'ui'
], function(utils, resize, $) {
    $('#PostField').autoResize({
        extraSpace: 16,
        animate: false,
        maxHeight: 320
    });
    $('#PostForm').submit(function(event) {
        utils.formAction('post.post', this, function(result) {
            if (result['status'] == 'OK') {
                window.location.reload();
            }
        });
        event.preventDefault();
    });
});