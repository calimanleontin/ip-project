$("#overlay").hide();
$("#calcRoute").hide();

function showMap(companyId) {
    $("#overlay").hide();

    $("#calcRoute").show();
    navigator.geolocation.getCurrentPosition(function (position) {
        var latLng = new google.maps.LatLng(
            position.coords.latitude, position.coords.longitude);
        $.get('/api/company-location/' + companyId, function (data) {

            var endLat = data['lat'];
            var endLng = data['lng'];
            var directionsDisplay;
            var directionsService = new google.maps.DirectionsService();
            var map;
            var routeBounds = false;
            var overlayWidth = 200; // Width of the overlay DIV
            var leftMargin = 30; // Grace margin to avoid too close fits on the edge of the overlay
            var rightMargin = 80; // Grace margin to avoid too close fits on the right and leave space for the controls

            overlayWidth += leftMargin;

            var start = latLng;
            var end = new google.maps.LatLng(endLat, endLng);

            function initialize(lat, lng) {


                var location = new google.maps.LatLng(lat, lng);


                var btn1 = document.getElementById('calcRoute');
                btn1.addEventListener('click', calcRoute);

                directionsDisplay = new google.maps.DirectionsRenderer({
                    draggable: true
                });

                var mapOptions = {
                    zoom: 16,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    center: end,
                    panControlOptions: {
                        position: google.maps.ControlPosition.TOP_RIGHT
                    },
                    zoomControlOptions: {
                        position: google.maps.ControlPosition.TOP_RIGHT
                    }
                };

                map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
                var marker = new google.maps.Marker({
                    position: location,
                    map: map,
                    draggable: false
                });

                directionsDisplay.setMap(map);

            }

            function offsetMap() {

                if (routeBounds !== false) {

                    // Clear listener defined in directions results
                    google.maps.event.clearListeners(map, 'idle');

                    // Top right corner
                    var topRightCorner = new google.maps.LatLng(map.getBounds().getNorthEast().lat(), map.getBounds().getNorthEast().lng());

                    // Top right point
                    var topRightPoint = fromLatLngToPoint(topRightCorner).x;

                    // Get pixel position of leftmost and rightmost points
                    var leftCoords = routeBounds.getSouthWest();
                    var leftMost = fromLatLngToPoint(leftCoords).x;
                    var rightMost = fromLatLngToPoint(routeBounds.getNorthEast()).x;

                    // Calculate left and right offsets
                    var leftOffset = (overlayWidth - leftMost);
                    var rightOffset = ((topRightPoint - rightMargin) - rightMost);

                    // Only if left offset is needed
                    if (leftOffset >= 0) {

                        if (leftOffset < rightOffset) {

                            var mapOffset = Math.round((rightOffset - leftOffset) / 2);

                            // Pan the map by the offset calculated on the x axis
                            map.panBy(-mapOffset, 0);

                            // Get the new left point after pan
                            var newLeftPoint = fromLatLngToPoint(leftCoords).x;

                            if (newLeftPoint <= overlayWidth) {

                                // Leftmost point is still under the overlay
                                // Offset map again
                                offsetMap();
                            }

                        } else {

                            // Cannot offset map at this zoom level otherwise both leftmost and rightmost points will not fit
                            // Zoom out and offset map again
                            map.setZoom(map.getZoom() - 1);
                            offsetMap();
                        }
                    }
                }
            }

            function fromLatLngToPoint(latLng) {

                var scale = Math.pow(2, map.getZoom());
                var nw = new google.maps.LatLng(map.getBounds().getNorthEast().lat(), map.getBounds().getSouthWest().lng());
                var worldCoordinateNW = map.getProjection().fromLatLngToPoint(nw);
                var worldCoordinate = map.getProjection().fromLatLngToPoint(latLng);

                return new google.maps.Point(Math.floor((worldCoordinate.x - worldCoordinateNW.x) * scale), Math.floor((worldCoordinate.y - worldCoordinateNW.y) * scale));
            }

            function calcRoute() {

                $("#overlay").show();

                var request = {
                    origin: start,
                    destination: end,
                    travelMode: google.maps.DirectionsTravelMode.DRIVING
                };

                directionsService.route(request, function (response, status) {

                    if (status == google.maps.DirectionsStatus.OK) {

                        directionsDisplay.setDirections(response);

                        // Define route bounds for use in offsetMap function
                        routeBounds = response.routes[0].bounds;

                        // Write directions steps
                        writeDirectionsSteps(response.routes[0].legs[0].steps);

                        // Wait for map to be idle before calling offsetMap function
                        google.maps.event.addListener(map, 'idle', function () {

                            // Offset map
                            offsetMap();
                        });

                        // Listen for directions changes to update bounds and reapply offset
                        google.maps.event.addListener(directionsDisplay, 'directions_changed', function () {

                            // Get the updated route directions response
                            var updatedResponse = directionsDisplay.getDirections();

                            // Update route bounds
                            routeBounds = updatedResponse.routes[0].bounds;

                            // Fit updated bounds
                            map.fitBounds(routeBounds);

                            // Write directions steps
                            writeDirectionsSteps(updatedResponse.routes[0].legs[0].steps);

                            // Offset map
                            offsetMap();
                        });
                    }
                });
            }

            function writeDirectionsSteps(steps) {

                var overlayContent = document.getElementById("overlayContent");
                overlayContent.innerHTML = '';

                for (var i = 0; i < steps.length; i++) {

                    overlayContent.innerHTML += '<p>' + steps[i].instructions + '</p><small>' + steps[i].distance.text + '</small>';
                }
            }

            //initialize( position.coords.latitude,  position.coords.longitude);
            initialize( data['lat'],  data['lng']);

        });
    });
}

