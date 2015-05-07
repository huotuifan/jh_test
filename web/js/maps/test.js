define(['jquery', 'ui'], function($) {
    var MARKER = null;
    var MAP = null;
    var latlng = new google.maps.LatLng(51.533333,46.016667);

    $("#Slider").draggable({
        axis: "y",
//        containment: "parent",
        distance: 10,
        drag: function(event, ui) {
            var h = ui.position.top;
            if (h > 16) {
                $('#Map').height(h);
            } else {
                $('#Map').height(0);
            }
            if (h < 0) {
                ui.position.top = 0;
            } else {
                google.maps.event.trigger(MAP, 'resize');
            }
        }
    });


    var myOptions = {
        scrollwheel: false,
        zoom: 14,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    $(function() {
        var h = $(document).height();
//                if (h < $('#map').height()) {
//                    $('#map').height(h - 50 < 100 ? 100 : h - 50);
//                }

        MAP = new google.maps.Map(document.getElementById("Map"), myOptions);
        google.maps.event.addListener(MAP, 'click', function(event) {
            setMarker(event.latLng);
        });
//        if (navigator.geolocation) {
//            navigator.geolocation.getCurrentPosition(success, error);
//        }
    });
    function success(position) {
        var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        console.log(position)
        setMarker(latlng);
    }

    function error(message) {

    }

    function setMarker(position) {
        if (!MARKER) {
            var image = new google.maps.MarkerImage('/i/icons/marker.png',
                new google.maps.Size(32, 32),
                new google.maps.Point(0, 0),
                new google.maps.Point(12, 29)
            );
            MARKER = new google.maps.Marker({
                position: position,
                icon: image,
                map: MAP
            });
        } else {
            MARKER.setPosition(position);
        }
        MAP.setCenter(position);
        $("#Lat").val(position.lat());
        $("#Lng").val(position.lng());
    }
});