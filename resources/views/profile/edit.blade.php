@extends('app')

@section('title')
    Edit {{ $profile->user->name }}'s profile
@endsection

@section('content')
    <div class="">
        <div class="">
            <div class="">
                <form class="form-horizontal" action="/update-profile" method="POST">

                    {!! Form::token() !!}

                    <div class="form-group">
                        <label for="firstName" class="ip-color control-label col-sm-2">First Name:</label>
                        <div class="col-sm-4">
                            @if(empty($profile->firstName))
                                <input type="text" class="form-control ip-input reset-border ip-button" name="firstName"  placeholder="First Name">
                            @else
                                <input type="text" class="form-control ip-input reset-border ip-button" name="firstName" value="{{ $profile->firstName }}"  placeholder="First Name">
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lastName" class="ip-color control-label col-sm-2">Last Name:</label>
                        <div class="col-sm-4">
                            @if(empty($profile->lastName))
                                <input type="text" class="form-control ip-input reset-border ip-button" name="lastName"  placeholder="Last Name">
                            @else
                                <input type="text" class="form-control ip-input reset-border ip-button" name="lastName" value="{{ $profile->lastName }}"  placeholder="Last Name">
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="avatar" class="ip-color control-label col-sm-2">Avatar:</label>
                        <div class="col-sm-4">
                            @if(empty($profile->avatar))
                                {!! Form::file('avatar', $attributes = array('class' => 'form-control')) !!}
                            @else
                                {!! Form::file('avatar', $attributes = array('class' => 'form-control')) !!}
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="birthday" class="ip-color control-label col-sm-2">Birthday:</label>
                        <div class="col-sm-4">
                            @if(empty($profile->birthday))
                                <input type="text" name="birthday" id="datePicker" class="form-control ip-input reset-border ip-button" placeholder="Birthday...">
                            @else
                                <input type="text" name="birthday" value="{{ $profile->birthday }}" id="datePicker" class="form-control ip-input reset-border ip-button" placeholder="Birthday...">
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="about" class="ip-color control-label col-sm-2">About me:</label>
                        <div class="col-sm-8">
                            <textarea name="about" class="form-control" placeholder="Type..."> {!! $profile->about!!}</textarea>
                        </div>
                    </div>

                    <div class="form-group" style="display: none;">
                        <label for="sex" class="ip-color control-label col-sm-2">Sex:</label>
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
                        <div class="col-sm-2">
                            <button type="submit" class="form-control btn ip-button primary-ip-button reset-border">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection