function emptyStar(x) {
    x.style.color = "black";
}

function fullStar(x) {
    x.style.color = "blue";

}

function saveLocation()
{
    navigator.geolocation.getCurrentPosition(function (position) {
        var lat = position.coords.latitude;
        var lng = position.coords.longitude;

        $.get('/api/save-location/' + lat + '/' + lng, function (data) {
            return false;
        });
    });
}