<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ip Project #1</title>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyB6K1CFUQ1RwVJ-nyXxd6W0rfiIBe12Q&libraries=places"
            type="text/javascript"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>-->
    <!--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->

    {{--<![endif]-->--}}

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <!-- JS -->
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script> <!-- load angular -->

    {{--ANGULAR--}}

    <script src="/js/controllers/mainCtrl.js"></script> <!-- load our controller -->
    <script src="/js/services/tagService.js"></script> <!-- load our tag service -->
    <script src="/js/services/commentService.js"></script> <!-- load our comment service -->
    <script src="/js/app.js"></script> <!-- load our application -->

    <script src="/js/local.js"></script> <!-- load local js -->

<body ng-app="app" ng-controller="mainController">
<nav class="navbar ip-navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav ptb14">
                <!--<br>-->
                <li>
                    <ul class="list list-inline">
                        <li>
                             <a href="{{ url('/') }}"><btn class="btn primary-ip-button ip-button reset-border">Home</btn></a>
                        </li>

                        <li>
                            <div class='search-left-space'>
                                <form class="form-inline" method='GET' action="/search">
                                    <ul class="list-inline">
                                        <li>
                                            <input type="text" id='search' class="form-control ip-input reset-border ip-button" name="q" placeholder="Type..." onclick="saveLocation()">
                                        </li>

                                        <li>
                                            <select class='form-control reset-select ip-select ip-input reset-border ip-button' name="distance">
                                                <option value="1" class='form-control display-block reset-border-radius ip-button primary-ip-button'>1km</option>
                                                <option value="10" class='form-control display-block reset-border-radius ip-button primary-ip-button'>10km</option>
                                                <option value="100" class='form-control display-block reset-border-radius ip-button primary-ip-button'>100km</option>
                                            </select>
                                        </li>

                                        <li>
                                            <input type="submit" value="Search" class="btn ip-button primary-ip-button reset-border" onclick="saveLocation()">
                                        </li>
                                    </ul>
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
            <!--<br>-->
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li>
                        <a href="{{ url('/auth/login') }}"><btn class="btn primary-ip-button ip-button reset-border">Login</btn></a>
                    </li>
                    <li>
                        <a href="{{ url('/auth/register') }}"><btn class="btn primary-ip-button ip-button reset-border">Register</btn></a>
                    </li>
                    <li>
                        <a href="{{ url('/company') }}"><btn class="btn primary-ip-button ip-button reset-border">Companies</btn></a>
                    </li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle ip-dropdown-menu" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu ip-light-color" role="menu">
                            @if(!Auth::guest() and Auth::user()->is_company() == false)
                                <li>
                                    <a class="ip-color" href="{{ url('/edit-profile') }}"><btn class="btn primary-ip-button ip-button reset-border">My Profile</btn></a>
                                </li>

                                <li>
                                    <a class="ip-color" href="{{ url('/auth/change-password') }}"><btn class="btn primary-ip-button ip-button reset-border">Change Password</btn></a>
                                </li>
                            @endif

                        @if(!Auth::guest() and Auth::user()->is_admin())
                                <li>
                                    <a href="{{ url('/create-tag') }}"><btn class="btn primary-ip-button ip-button reset-border">New Tag</btn></a>
                                </li>
                            @endif

                        @if(!Auth::guest() and Auth::user()->is_company())
                            <li>
                                <a class="ip-color" href="{{ url('/company/edit') }}"><btn class="btn primary-ip-button ip-button reset-border">Edit Company</btn></a>
                            </li>
                            <li>
                                <a class="ip-color" href="{{ url('/company/campaign/create') }}"><btn class="btn primary-ip-button ip-button reset-border">Create campaign</btn></a>
                            </li>

                            <li>
                                <a class="ip-color" href="{{ url('/auth/change-password') }}"><btn class="btn primary-ip-button ip-button reset-border">Change Password</btn></a>
                            </li>
                        @endif
                            <li>
                                <a class="ip-color" href="{{ url('/auth/logout') }}"><btn class="btn primary-ip-button ip-button reset-border">Logout</btn></a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    @if (Session::has('message'))
        <div class="flash alert-info">
            <p class="panel-body">
                {{ Session::get('message') }}
            </p>
        </div>
    @endif
    @if ($errors->any())
        <div class='flash alert-danger'>
            @foreach ( $errors->all() as $error )
                <p class="panel-body">
                    {{ $error }}
                </p>
            @endforeach
        </div>
    @endif


    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel ip-panel">
                <div class="panel-heading">
                    <h2>@yield('title')</h2>
                    @yield('title-meta')
                </div>
                <div class="panel-body">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>