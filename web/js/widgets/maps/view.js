define([
    'require',
    'jquery'
], function (require, $) {

    var MY_ZOOM = 13,
        mapOptions = {
            zoom: MY_ZOOM,
            center: new google.maps.LatLng(54.521081, 15.292969),
            panControl: false,
            zoomControl: false,
            mapTypeControl: false,
            scaleControl: false,
            streetViewControl: false,
            overviewMapControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        },
        image = new google.maps.MarkerImage(
            require.toUrl('./location-red.png'),
            new google.maps.Size(16, 19),
            new google.maps.Point(0, 0),
            new google.maps.Point(8, 19)
        );


    return {
        init: function (id) {
            var $map = $('#' + id),
                map,
                marker;
            return {
                show: function (place) {
                    $map.show();
                    if (!map) {
                        map = new google.maps.Map($map[0], mapOptions);
                    }
                    var latLng = new google.maps.LatLng(place['place_lat'], place['place_lng']);
                    map.setCenter(latLng);
                    map.setZoom(MY_ZOOM);
                    if (marker) {
                        marker.setMap(null);
                    }
                    marker = new google.maps.Marker({
                        map: map,
                        position: latLng,
                        icon: image
                    });
                },
                clear: function () {
                    $map.hide();
                    if (marker) {
                        marker.setMap(null);
                    }
                }
            };
        }
    }

});