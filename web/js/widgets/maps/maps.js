define([
    'require',
    'jquery',
    'lib/markerclusterer/markerclusterer_packed'
], function (require, $) {

    var mapDefault = new google.maps.LatLng(54.521081, 15.292969);

    function getButtons(map) {

        var container = $('<div class="nm-Map-buttons"></div>');

        var buttonLocal = $('<div class="nm-Map-button">Local</div>').css({
            borderRight: 'none'
        }).appendTo(container);

        buttonLocal.click(function () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var latLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    map.setCenter(latLng);
                    map.setZoom(12);
                });
            }
        });

        var buttonGlobal = $('<div class="nm-Map-button">Global</div>').appendTo(container);

        buttonGlobal.click(function () {
            map.setCenter(mapDefault);
            map.setZoom(2);
        });

        return container[0];
    }

    function createTypedMarkerImage(type) {
        var pointCenter = 8, pointWidth = 16, pointHeight = 19;
        if (typeof type === 'undefined') {
            type = window.devicePixelRatio > 1 ? 'red-retina' : 'red';
        } else {
            if (type === 'ffm') {
                pointCenter = 6;
                pointWidth = 12;
                pointHeight = 20;
            } else {
                pointCenter = 12.5;
                pointWidth = 25;
                pointHeight = 20;
            }
        }

        return new google.maps.MarkerImage(
            require.toUrl('./location-' + type + '.png'),
            null,
            new google.maps.Point(0, 0),
            new google.maps.Point(pointCenter, pointHeight),
            new google.maps.Size(pointWidth, pointHeight)
        );
    }

    function setMarker(position, markerType) {
        if (!this.marker) {
            this.marker = new google.maps.Marker({
                icon: createTypedMarkerImage(markerType),
                map: this.map
            });
        }

        this.marker.setPosition(position);
    }

    return {
        init: function (el, options) {
            var settings = $.extend({
                scrollwheel: false,
                zoom: 3,
                center: mapDefault,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                panControl: false,
                zoomControl: true,
                zoomControlOptions: {
                    position: google.maps.ControlPosition.LEFT_TOP
                },
                mapTypeControl: true,
                mapTypeControlOptions: {
                    position: google.maps.ControlPosition.TOP_RIGHT
                },
                scaleControl: false,
                streetViewControl: false,
                overviewMapControl: false
            }, options);

            var map = new google.maps.Map(el.get(0), settings);
            var markerClusterer = new MarkerClusterer(map, [], {
                zoomOnClick: false,
                imagePath: '/js/lib/markerclusterer/images/m'
            });

            google.maps.event.addListener(markerClusterer, 'click', function (cluster) {
                map.setCenter(cluster.getCenter());
                map.setZoom(map.getZoom() + 1);
            });

            if (!settings['readonly']) {
                map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(getButtons(map));
            }

            return {
                map: map,
                places: [],
                setMarker: function (lat, lng, markerType) {
                    var latlng = new google.maps.LatLng(lat, lng);
                    setMarker.call(this, latlng, markerType);
                },
                clearPlaces: function () {
                    this.places = [];
                    markerClusterer.clearMarkers();
                },
                addPlaces: function (places) {
                    var self = this;
                    $.each(places, function (i, place) {
                        var position = new google.maps.LatLng(place['place_lat'], place['place_lng']);
                        var postType = place['postType'];
                        if (typeof place['postType'] === 'undefined' && place['place_ffm_id'] != 0) {
                            postType = 'ffm';
                        }

                        var marker = new google.maps.Marker({
                            optimized: false,
                            icon: createTypedMarkerImage(postType),
                            position: position,
                            map: self.map
                        });

                        google.maps.event.addListener(marker, 'click', function () {
                            if ( place['place_ffm_id'] == 0) {
                                window.open('places/' + place['place_uuid'], '_blank');
                            } else {
                                window.open('http://www.farfrommoscow.com/artists/?region=' + place['place_ffm_filename'], '_blank');
                            }
                        });
                        self.places.push(marker);
                    });

                    markerClusterer.addMarkers(self.places);
                }
            }
        }
    }
});