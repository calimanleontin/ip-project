@extends('app')
@section('title')
    Register
@endsection

@section('content')
    <div class="col-sm-4">
        {{Form::open(array('url'=>'/company/register', 'files'=>true))}}

        {!! Form::token()    !!}
        <div class="form-group">

            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', '', ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            <label for="">Map</label>
            <input type="text" id="searchmap" placeholder="Search" class="form-control">
            <div id="map-canvas"></div>
        </div>

        <div class="form-group">
            <label for="">Lat</label>
            <input type="text" class="form-control input-sm" name="lat" id="lat" required>
        </div>

        <div class="form-group">
            <label for="">Lng</label>
            <input type="text" class="form-control input-sm" name="lng" id="lng" required>
        </div>

        <div class="form-group">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::text('email', '', ['class'=>'form-control', 'placeholder' => 'Email', 'required' => true, 'type' => 'email']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password', ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('confirm', 'Confirm:') !!}
            {!! Form::password('confirm', ['class'=>'form-control','required']) !!}
        </div>

        <div class="col-md-5">
            {!! Form::submit('Submit', ['class'=>'form-control btn btn-default']) !!}
        </div>

        {{Form::close()}}
    </div>


    <script>


        var map = new google.maps.Map(document.getElementById('map-canvas'),{
            center:{
                lat: 44.42,
                lng: 26.10
            },
            zoom:15
        });

        var marker = new google.maps.Marker({
            position: {
                lat: 44.42,
                lng: 26.10
            },
            map: map,
            draggable: true
        });

        var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));

        google.maps.event.addListener(searchBox,'places_changed',function(){

            var places = searchBox.getPlaces();
            var bounds = new google.maps.LatLngBounds();
            var i, place;

            for(i=0; place=places[i];i++){
                bounds.extend(place.geometry.location);
                marker.setPosition(place.geometry.location); //set marker position new...
            }

            map.fitBounds(bounds);
            map.setZoom(15);

        });

        google.maps.event.addListener(marker,'position_changed',function(){

            var lat = marker.getPosition().lat();
            var lng = marker.getPosition().lng();

            $('#lat').val(lat);
            $('#lng').val(lng);

        });

    </script>


@endsection


