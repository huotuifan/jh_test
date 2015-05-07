define([
    'require',
    'jquery',
    'common/utils'
], function (require, $, utils) {

    var mapCenter = new google.maps.LatLng(54.521081, 15.292969),
        mapOptions = {
            zoom: 4,
            center: mapCenter,
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
            overviewMapControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        },
        image = new google.maps.MarkerImage(
            require.toUrl('./location-red.png'),
            new google.maps.Size(16, 19),
            new google.maps.Point(0, 0),
            new google.maps.Point(8, 19)
        ),
        drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.MARKER,
            drawingControl: true,
            drawingControlOptions: {
                position: google.maps.ControlPosition.RIGHT_BOTTOM,
                drawingModes: [
                    google.maps.drawing.OverlayType.MARKER
                ]
            },
            markerOptions: {
                draggable: true,
                icon: image
            }
        }),
        currentMarker;

    google.maps.event.addListener(drawingManager, 'markercomplete', function (marker) {
        if (currentMarker) {
            currentMarker.setMap(null);
        }
        currentMarker = marker;
    });

    function SearchControl(el, map) {
        var autocomplete = new google.maps.places.Autocomplete(el);
        autocomplete.bindTo('bounds', map);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();

            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(14);
            }

            if (currentMarker) {
                currentMarker.setPosition(place.geometry.location);
            } else {
                currentMarker = new google.maps.Marker({
                    map: map,
                    position: place.geometry.location,
                    draggable: true,
                    icon: image
                });
            }
            $('#PlaceEditorName').val(place.name);
        });
    }

    var searchElement = $('<input type="text" placeholder="Search" autocomplete="off" class="nm-Map-search f-input-noradius">');

    var wnd = $('#PlaceEditor').dialog({
        draggable: false,
        autoOpen: false,
        modal: true,
        resizable: false,
        position: 'center',
        width: $(window).width() > 480 ? 460 : '92%',
        open: function () {
            var map = new google.maps.Map(document.getElementById('PlaceEditorMap'), mapOptions);
            new SearchControl(searchElement[0], map);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(searchElement[0]);
            drawingManager.setMap(map);

            if ($('#PlaceEditorId').val() != '') {
                var lat = $('#PlaceEditorLat').val();
                var lng = $('#PlaceEditorLng').val();
                var placeLocation = new google.maps.LatLng(lat, lng);
                currentMarker = new google.maps.Marker({
                    map: map,
                    position: placeLocation,
                    draggable: true,
                    icon: image
                });
                map.setCenter(placeLocation);
                map.setZoom(14);
            } else {
                currentMarker = null;
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        var latLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                        map.setCenter(latLng);
                        map.setZoom(14);
                    });
                }
            }
        }
    });

    var firstRun = true,
        callback;

    function init() {
        if (firstRun) {
            $('#PlaceForm').submit(function (e) {
                $('#ErrorMessage').hide();

                if (currentMarker) {
                    var pos = currentMarker.getPosition();
                    $('#PlaceEditorLat').val(pos.lat());
                    $('#PlaceEditorLng').val(pos.lng());
                }

                var model = arrayToMap($('#PlaceForm').serializeArray());

                utils.simpleAction(
                    'place.save',
                    model,
                    function (result) {
                        if (result.isOk()) {
                            wnd.dialog('close');
                            if (callback) {
                                callback(result.model);
                            }
                        }
                    }
                );

                e.preventDefault();
            });

            $('#PlaceForm input[type=button]').click(function () {
                wnd.dialog('close');
            });
        }
        firstRun = false;
    }

    function arrayToMap(arr) {
        var model = {};
        $.each(arr, function () {
            if (model[this.name] !== undefined) {
                if (!model[this.name].push) {
                    model[this.name] = [model[this.name]];
                }
                model[this.name].push(this.value || '');
            } else {
                model[this.name] = this.value || '';
            }
        });
        return model;
    }

    return {
        open: function (value, _callback) {
            var model = {
                place_name: value || ''
            };

            this.edit(model, _callback)
        },
        editArray: function (placeArray, _callback) {
            var model = arrayToMap(placeArray);
            this.edit(model, _callback)
        },
        edit: function (place, _callback) {
            callback = _callback;

            init();

            var $name = $('#PlaceEditorName').val(place['place_name']);
            $('#PlaceEditorAbout').val(place['place_about']);
            $('#PlaceEditorId').val(place['place_id']);
            $('#PlaceEditorLat').val(place['place_lat']);
            $('#PlaceEditorLng').val(place['place_lng']);

            searchElement.val('');

            wnd.dialog('open');

            $name.focus();
        }
    }

});