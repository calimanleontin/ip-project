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

            @if(!empty($company->image))
                <div class="img-rounded col-md-7">
                    <img src="/images/companies/{{ $company->image }}"  class="company-image">
                </div>
            @endif

            <div class="form-group col-md-7">
                {!! Form::label('image', 'Upload avatar:') !!}
                {!! Form::file('image', null) !!}
            </div>

            <div class="form-group col-md-10">
                <label for="description">Description:</label>
                <textarea name = 'description' class="form-control">{!! $company->description !!}</textarea>
            </div>

            <div class="form-group col-md-7">
                <label for="">Map</label>
                <input type="text" id="searchmap" placeholder="Search" class="form-control">
                <div id="map-canvas"></div>
                <script>

                    var map = new google.maps.Map(document.getElementById('map-canvas'),{
                        center:{
                            lat: <?php echo $company->lat; ?>,
                            lng: <?php echo $company->lng; ?>
                        },
                        zoom:15
                    });

                    var marker = new google.maps.Marker({
                        position: {
                            lat: <?php echo $company->lat; ?>,
                            lng: <?php echo $company->lng; ?>
                        },
                        map: map,
                        draggable: true
                    });

                </script>
                <script src="/js/editMap.js"></script> <!-- load the map -->


            </div>

            <div class="form-group col-md-7">
                <label for="lat">Lat</label>
                <input type="text" class="form-control input-sm" value = "{{ $company->lat }}" name="lat" id="lat" required>
            </div>

            <div class="form-group col-md-7">
                <label for="lng">Lng</label>
                <input type="text" class="form-control input-sm" value = "{{ $company->lng }}" name="lng" id="lng" required>
            </div>


            <div class="col-md-2 submit-management-down submit-management-left">
                {!! Form::submit('Submit', ['class'=>'form-control btn btn-default']) !!}
            </div>

            {!! Form::close() !!}

            <div class="col-md-9">
                <h4>
                    Actual tags:
                </h4>
            </div>
            <div class="col-md-9" ng-hide="loading" ng-repeat="tag in tags">

                <ul class="list-inline" >
                    <li> @{{ tag.name }}</li>
                    <li><a href="" ng-click="deleteTag(tag.id)" class="text-muted">x</a></li>
                </ul>
            </div>


            <form ng-submit="submitTag()">
                    <div class="col-md-7">
                        <label for="tags">Tags:</label>
                        <select class="form-control" ng-model="tagData.tag">
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="submit" value = 'Add tag' class="btn btn-default">
                </form>

        </div>

    </div>

@endsection