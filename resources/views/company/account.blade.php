@extends('app')
@section('title')
    Welcome
@endsection

@section('content')
    <div class="">
        <div class="list-group">
        <ul class="list-inline">
            <li class="col-md-6">
                <div class="list-group-item">
                    <a href="/company/register"><button class="btn btn-default">Register</button></a>
                </div>
            </li>

            <li class="col-md-6">
                <div class="list-group-item">
                    <a href="/company/login"><button class="btn btn-default">Login</button></a>
                </div>
            </li>
        </ul>
    </div>
@endsection


