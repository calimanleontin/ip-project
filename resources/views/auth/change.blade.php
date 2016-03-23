@extends('app')
@section('title')
    Change Password
@endsection
@section('content')
    <form method="POST" action="/auth/update-password" class="form-horizontal">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <label class="control-label col-sm-2" for="actualPassword">Actual Password:</label>
            <div class="col-sm-4">
                <input type="password" name="actualPassword" class="form-control" id="email" placeholder="Actual password">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="newPassword">New Password:</label>
            <div class="col-sm-4">
                <input type="password" name="newPassword" class="form-control" id="email" placeholder="New password">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="confirmPassword">Confirm:</label>
            <div class="col-sm-4">
                <input type="password" name="confirmPassword" class="form-control" id="email" placeholder="Confirm password">
            </div>
        </div>


        <div class="col-sm-2">
            <input type="submit" class="form-control btn btn-success" value="Change">
        </div>

    </form>
@endsection