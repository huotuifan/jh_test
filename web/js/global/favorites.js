define([
    'common/utils',
    'jquery'
], function (utils, $) {

    function doAction(user, place, data) {
        var action;

        if (user) {
            action = 'favorites.user';
            data['user_id_favorited'] = user;
        } else {
            action = 'favorites.place';
            data['place_id'] = place;
        }

        utils.simpleAction(action, data,
            function (result) {
                if (result.isOk()) {
                    window.location.reload();
                }
            }
        );
    }

    $('.nm-Favorites-remove').click(function () {
        var user = $(this).data('user'),
            place = $(this).data('place'),
            data = {
                remove: true
            };

        doAction(user, place, data);
    });

    $('.nm-Favorites-add').click(function () {
        var user = $(this).data('user'),
            place = $(this).data('place');

        doAction(user, place, {});
    });

});