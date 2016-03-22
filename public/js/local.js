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

function loadCompanies()
{
    $.get('/api/auto-complete', function(data){

        var sugestions = [];

        for(var index = 0; index < data['companies'].length; index ++)
        {
            sugestions.push(data['companies'][index].name)
        }

        for(var index = 0; index < data['tags'].length; index ++)
        {
            sugestions.push(data['tags'][index].name)
        }


        $('#search').autocomplete({
            source:sugestions
        });

    });
}
//
//for(var item in data['categories'])
//{
//    alert(item.name);
//    sugestions.push({label : item.name, category : 'Companies'})
//}
//
//for(var item in data['tags'])
//{
//    sugestions.push({label : item.name, category : 'Tags'})
//}