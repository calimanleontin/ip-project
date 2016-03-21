$(function () {
    $("#showMyLocation").click(function () {
        navigator.geolocation.getCurrentPosition(function (position) {
            var latLng   = new google.maps.LatLng(
                position.coords.latitude, position.coords.longitude);
            alert(latLng);
        });
        return false;
    });
});
