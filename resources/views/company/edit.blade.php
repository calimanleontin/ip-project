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


            @if(!empty($company->image))
                <div class="form-group">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10 form-group img-rounded">
                        <img src="/images/companies/{{ $company->image }}" class="img-rounded" style="padding: 15px;">
                    </div>
                </div>
            @endif

            <div class="form-group">
                <!--{!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', $user->name, array('class' => 'form-control', 'required', 'placeholder' => 'Name')) !!}-->
                <label class="ip-color control-label col-sm-2" for="name">Name:</label>
                <div class="col-sm-4">
                    <input class="form-control ip-input reset-border ip-button" required="required" placeholder="Name" name="name" value="{{ $user->name }}" id="name" type="text">
                </div>
            </div>

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
            
            <div class="form-group ip-wysiwyg col-sm-10">
                <textarea name = 'description' class="form-control">{!! $company->description !!}</textarea>
            </div>
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

            <div class="col-md-12 form-group">
                <div class="col-md-2 submit-management-down submit-management-left">
                    <!--{!! Form::submit('Submit', ['class'=>'form-control btn btn-default']) !!}-->
                    <input class="form-control btn ip-button primary-ip-button reset-border" value="Submit" type="submit">
                </div>
            </div>

            {!! Form::close() !!}

            <form ng-submit="submitTag()">
                
                <div class="form-group">
                    <label class="ip-color control-label col-sm-2" for="lng">Actual tags: </label>
                    <div class="col-sm-10" ng-hide="loading" ng-repeat="tag in tags">

                        <ul class="list-inline" >
                            <li> @{{ tag.name }}</li>
                            <li><a href="" ng-click="deleteTag(tag.id)" class="text-muted">x</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="ip-color control-label col-sm-2" for="tags">Tags:</label>
                    <div class="col-sm-10">
                        <select class="form-control col-sm-10" ng-model="tagData.tag">
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <div class="col-sm-2">
                        <input type="submit" value = 'Add tag' class="form-control btn ip-button primary-ip-button reset-border">
                    </div>
                </div>
            </form>

        </div>

    </div>

@endsection