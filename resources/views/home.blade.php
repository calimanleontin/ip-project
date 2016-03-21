@extends('app')
@section('title')
    @if(!empty($title))
        {{$title}}
    @else
        Companies
    @endif
@endsection

@section('content')

    <div class="">
        <div class="list-group">
            @foreach($companies as $company)
                <div class="list-group-item">
                    <ul class="list-inline">
                        <li>
                            <a href="/company/{{ $company->slug }}"> View {{ $company->name }} web page.</a>
                        </li>
                        <li>
                            <btn class="btn btn-default" onClick="showMap({{ $company->id }})">Show map</btn>
                        </li>
                    </ul>
                </div>
            @endforeach
        </div>
        <button id="calcRoute">Calc route</button>

        <div id="map-canvas"></div>
        <div id="overlay">
            <div id="overlayContent">


            </div>
        </div>
    <script src="/js/myLocation.js"></script>
    </div>

@endsection
