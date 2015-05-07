define([
    'common/utils',
    'jquery',
    'jqueryui/autocomplete'
], function(utils, $) {

    function onPlaceSelect(place, iMap) {
        var latLng = new google.maps.LatLng(place['place_lat'], place['place_lng']);
        iMap.map.setCenter(latLng);
        iMap.map.setZoom(13);
    }

    function init(iMap) {
        $('.nm-Search-input').autocomplete({
            source: function (request, response) {
                utils.simpleAction('place.search', {
                        term: request.term
                    },
                    function (result) {
                        response(result['places']);
                    }
                );
            },
            minLength: 2,
            focus: function (event, ui) {
                $(".nm-Search-input").val(ui.item['place_name']);
                return false;
            },
            select: function (event, ui) {
                if (ui.item) {
                    onPlaceSelect(ui.item, iMap);
                } else {
//                clearPlaceSelection();
                }
            }
        }).data('autocomplete')._renderItem = function (ul, item) {
            return $('<li></li>')
                .data('item.autocomplete', item)
                .append('<a>' + item['place_name'] + '</a>')
                .appendTo(ul);
        };
    }

    return {
        init: init
    };

});