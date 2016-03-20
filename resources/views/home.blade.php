@extends('app')
@section('title')
    @if(!empty($title))
        {{$title}}
    @else
        My location
    @endif
@endsection
@section('content')
    <div class="">
            <a href="#" id="showMyLocation">Where Am I</a>
        <script>
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
        </script>
    </div>
@endsection
