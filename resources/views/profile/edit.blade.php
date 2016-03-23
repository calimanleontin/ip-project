@extends('app')

@section('title')
    Edit {{ $profile->user->name }}'s profile
@endsection

@section('content')
    <div class="">
        <div class="panel-body">
            <div class="list-group">
                <form class="form-horizontal" action="/update-profile" method="POST">

                    {!! Form::token() !!}

                    <div class="form-group">
                        <label for="firstName" class="col-sm-2 control-label">First Name:</label>
                        <div class="col-sm-6">
                            @if(empty($profile->firstName))
                                <input type="text" class="form-control" name="firstName"  placeholder="First Name">
                            @else
                                <input type="text" class="form-control" name="firstName" value="{{ $profile->firstName }}"  placeholder="First Name">
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lastName" class="col-sm-2 control-label">Last Name:</label>
                        <div class="col-sm-6">
                            @if(empty($profile->lastName))
                                <input type="text" class="form-control" name="lastName"  placeholder="Last Name">
                            @else
                                <input type="text" class="form-control" name="lastName" value="{{ $profile->lastName }}"  placeholder="Last Name">
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="avatar" class="col-sm-2 control-label">Avatar:</label>
                        <div class="col-sm-6">
                            @if(empty($profile->avatar))
                                {!! Form::file('avatar', $attributes = array('class' => 'form-control')) !!}
                            @else
                                {!! Form::file('avatar', $attributes = array('class' => 'form-control')) !!}
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="birthday" class="col-sm-2 control-label">Birthday:</label>
                        <div class="col-sm-6">
                            @if(empty($profile->birthday))
                                <input type="data" name="birthday" id="datePicker" class="form-control" placeholder="Birthday...">
                            @else
                                <input type="data" name="birthday" value="{{ $profile->birthday }}" id="datePicker" class="form-control" placeholder="Birthday...">
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="about" class="col-sm-2 control-label">About me:</label>
                        <div class="col-sm-8">
                            <textarea name="about" class="form-control" placeholder="Type..."> {!! $profile->about!!}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sex" class="col-sm-2 control-label">Sex:</label>
                        <div class="col-sm-2">
                            <select name="sex" class="form-control">
                                @if(empty($profile->sex))
                                    <option value="masc">Masc</option>
                                    <option value="fem">Fem</option>
                                @elseif($profile->sex == 'masc')
                                    <option value="masc" selected="selected">Masc</option>
                                    <option value="fem">Fem</option>
                                @else
                                    <option value="masc">Masc</option>
                                    <option value="fem" selected="selected">Fem</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection