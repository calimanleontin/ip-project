@extends('app')
@section('title')
    Register
@endsection
@section('content')
    <form method="POST" action="/auth/register" class="form-horizontal">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">


        <div class="form-group">
            <label class="ip-color control-label col-sm-2" for="username">Username:</label>
            <div class="col-sm-4">
                @if(!empty($username))
                    <input type="text" class="form-control ip-input reset-border ip-button" name = 'username' id="username" value = "{{$username}}" placeholder="Enter username">
                @else
                    <input type="text" name = 'username' class="form-control ip-input reset-border ip-button" id="username"  placeholder="Enter username">
                @endif

            </div>
        </div>


        <div class="form-group">
            <label class="ip-color control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-4">
                @if(!empty($email))
                    <input type="email" class="form-control ip-input reset-border ip-button" name ='email' value="{{$email}}" id="email" placeholder="Enter email">
                @else
                    <input type="email" class="form-control ip-input reset-border ip-button" name="email" id="email" placeholder="Enter email">
                @endif

            </div>
        </div>

        <div class="form-group">
            <label class="ip-color control-label col-sm-2" for="password">Password:</label>
            <div class="col-sm-4">
                <input type="password" class="form-control ip-input reset-border ip-button" name='password' id="password" placeholder="Enter password">
            </div>
        </div>

        <div class="form-group">
            <label class="ip-color control-label col-sm-2" for="confirm">Confirm:</label>
            <div class="col-sm-4">
                <input type="password" class="form-control ip-input reset-border ip-button" name='confirm' id="confirm" placeholder="Confirm password">
            </div>
        </div>

        <div class="col-sm-2">
            <input type="submit" class="form-control btn ip-button primary-ip-button reset-border" value="Register">
        </div>

    </form>
@endsection