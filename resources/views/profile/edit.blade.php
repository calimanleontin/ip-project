@extends('app')

@section('title')
    Edit {{ $profile->user->name }}'s profile
@endsection

@section('content')
    <div class="">
        <div class="panel-body">
            <div class="list-group">
                <form class="form-horizontal" action="/update-profile" method="POST">

                    <div class="form-group">
                        <label for="firstName" class="col-sm-2 control-label">First Name:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="firstName"  placeholder="First Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lastName" class="col-sm-2 control-label">Last Name:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="lastName"  placeholder="Last Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Sign in</button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
@endsection