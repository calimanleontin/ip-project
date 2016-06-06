@extends('app')
@section('title')
    Register
@endsection

@section('content')
    <div class="col-sm-12 form-horizontal">
        {{Form::open(array('url'=>'/company/register', 'files'=>true))}}

        {!! Form::token()    !!}
        <div class="form-group">
            <!--{!! Form::label('name', 'Name') !!}
            {!! Form::text('name', '', ['class'=>'form-control', 'required']) !!}-->
            <label class="ip-color control-label col-sm-2" for="name">Name</label>
            <div class="col-sm-5">
                <input class="form-control ip-input reset-border ip-button" required="required" name="name" value="" id="name" type="text">
            </div>
        </div>

        <div class="form-group">
            <label class="ip-color control-label col-sm-2" for="searchmap">Map</label>
            <div class="col-sm-5">
                <input type="text" id="searchmap" placeholder="Search" class="form-control ip-input reset-border ip-button">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <div id="map-canvas"></div>
            </div>
            <script src="/js/map.js"></script> <!-- load the map -->
        </div>

        <div class="form-group">
            <label class="ip-color control-label col-sm-2" for="lat">Lat</label>
            <div class="col-sm-5">
                <input type="text" class="form-control ip-input reset-border ip-button input-sm" name="lat" id="lat" required>
            </div>
        </div>

        <div class="form-group">
            <label class="ip-color control-label col-sm-2" for="lng">Lng</label>
            <div class="col-sm-5">
                <input type="text" class="form-control ip-input reset-border ip-button input-sm" name="lng" id="lng" required>
            </div>
        </div>

        <div class="form-group">
            <!--{!! Form::label('email', 'Email:') !!}
            {!! Form::text('email', '', ['class'=>'form-control', 'placeholder' => 'Email', 'required' => true, 'type' => 'email']) !!}-->
            <label class="ip-color control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-5">
                <input class="form-control ip-input reset-border ip-button" placeholder="Email" required="1" name="email" value="" id="email" type="text">
            </div>
        </div>

        <div class="form-group">
            <!--{!! Form::label('password', 'Password:') !!}
            {!! Form::password('password', ['class'=>'form-control', 'required']) !!}-->
            <label class="ip-color control-label col-sm-2" for="password">Password:</label>
            <div class="col-sm-5">
                <input class="form-control ip-input reset-border ip-button" required="required" name="password" value="" id="password" type="password">
            </div>
        </div>

        <div class="form-group">
            <!--{!! Form::label('confirm', 'Confirm:') !!}
            {!! Form::password('confirm', ['class'=>'form-control','required']) !!}-->
            <label class="ip-color control-label col-sm-2" for="confirm">Confirm:</label>
            <div class="col-sm-5">
                <input class="form-control ip-input reset-border ip-button" required="required" name="confirm" value="" id="confirm" type="password">
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-md-2">
                <!--{!! Form::submit('Submit', ['class'=>'form-control btn btn-default']) !!}-->
                <input class="form-control btn ip-button primary-ip-button reset-border" value="Submit" type="submit">
            </div>
        </div>

        {{Form::close()}}
    </div>

@endsection


