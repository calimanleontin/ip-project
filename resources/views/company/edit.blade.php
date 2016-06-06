@extends('app')

@section('title')
    Edit
@endsection

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>

@section('content')
    <div class="form-horizontal">
        <div class="form-group">

            {!! Form::open(array('url' => '/company/update', 'files' => true, 'class' => '')) !!}

            <div class="form-group">
                <!--{!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', $user->name, array('class' => 'form-control', 'required', 'placeholder' => 'Name')) !!}-->
                <label class="ip-color control-label col-sm-2" for="name">Name:</label>
                <div class="col-sm-4">
                    <input class="form-control ip-input reset-border ip-button" required="required" placeholder="Name" name="name" value="denis" id="name" type="text">
                </div>
            </div>

            @if(!empty($company->image))
                <div class="img-rounded col-md-7">
                    <img src="/images/companies/{{ $company->image }}"  class="company-image">
                </div>
            @endif

            <div class="form-group">
                <!--{!! Form::label('image', 'Upload avatar:') !!}
                {!! Form::file('image', null) !!}-->
                <label class="ip-color control-label col-sm-2" for="image">Upload avatar:</label>
                <div class="col-sm-4">
                    <input class="form-control ip-input reset-border ip-button" name="image" id="image" type="file">
                </div>
            </div>

            <div class="form-group">
                <label class="ip-color control-label col-sm-2" for="description">Description:</label>
                <textarea name = 'description' class="form-control">{!! $company->description !!}</textarea>
            </div>

            <div class="form-group">
                <label class="ip-color control-label col-sm-2" for="">Map</label>
                <div class="col-sm-4">
                    <input type="text" id="searchmap" placeholder="Search" class="form-control ip-input reset-border ip-button">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2"></div>
                <div class="col-sm-4">
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
            </div>

            <div class="form-group">
                <label class="ip-color control-label col-sm-2" for="lat">Lat</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control ip-input reset-border ip-button input-sm" value = "{{ $company->lat }}" name="lat" id="lat" required>
                </div>
            </div>

            <div class="form-group">
                <label class="ip-color control-label col-sm-2" for="lng">Lng</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control ip-input reset-border ip-button input-sm" value = "{{ $company->lng }}" name="lng" id="lng" required>
                </div>
            </div>


            <div class="col-md-2 submit-management-down submit-management-left">
                <!--{!! Form::submit('Submit', ['class'=>'form-control btn btn-default']) !!}-->
                <input class="form-control btn ip-button primary-ip-button reset-border" value="Submit" type="submit">
            </div>

            {!! Form::close() !!}

            <!--<div class="col-md-9">
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
            </form>-->

        </div>

    </div>

@endsection