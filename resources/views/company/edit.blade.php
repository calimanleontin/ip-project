@extends('app')

@section('title')
    Edit
@endsection


<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>


@section('content')
    <div class="">
        <div class="form-group">

            {!! Form::open(array('url' => '/company/update', 'files' => true, 'class' => '')) !!}

            <div class="form-group col-md-7">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', $user->name, array('class' => 'form-control', 'required', 'placeholder' => 'Name')) !!}
            </div>

            <div class="form-group col-md-10">
                <label for="description">Description:</label>
                <textarea name = 'description' class="form-control">{!! $company->description !!}</textarea>
            </div>

            <div class="form-group col-md-7">
                <label for="">Map</label>
                <input type="text" id="searchmap" placeholder="Search" class="form-control">
                <div id="map-canvas"></div>
                <script src="/js/map.js"></script> <!-- load the map -->

            </div>

            <div class="form-group col-md-7">
                <label for="">Lat</label>
                <input type="text" class="form-control input-sm" name="lat" id="lat" required>
            </div>

            <div class="form-group col-md-7">
                <label for="">Lng</label>
                <input type="text" class="form-control input-sm" name="lng" id="lng" required>
            </div>
            <div class="col-md-2 submit-management-down submit-management-left">
                {!! Form::submit('Submit', ['class'=>'form-control btn btn-default']) !!}
            </div>

            {!! Form::close() !!}

        </div>

    </div>

@endsection