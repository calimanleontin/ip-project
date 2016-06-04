@extends('app')
@section('title')
    Welcome
@endsection

@section('content')
    <div class="panel-body"></div>
    <div class="">
        <div class="list-group">
        <!--<ul class="list-inline">
            <li class="col-md-6">-->
                <div class="list-group-item be-cleared reset-padding overflow-hidden ip-list-group-item">
                    <a href="/company/register"><button class="col-md-6 reset-border-radius reset-border primary-ip-button ip-button ptb20">Register</button></a>
                <!--</div>
            </li>

            <li class="col-md-6">
                <div class="list-group-item">-->
                    <a href="/company/login"><button class="col-md-6 reset-border-radius reset-border secondary-ip-button ip-button ptb20">Login</button></a>
                </div>
            <!--</li>
        </ul>-->
    </div>
@endsection


