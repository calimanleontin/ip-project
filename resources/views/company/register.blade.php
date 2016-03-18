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
            <script src="/js/map.js"></script> <!-- load the map -->
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

@endsection


