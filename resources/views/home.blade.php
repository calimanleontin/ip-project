@extends('app')
@section('title')
    @if(!empty($title))
        {{$title}}
    @else
        My location
    @endif
@endsection

@section('content')

    <div class="">
        <div class="list-group">
            @foreach($companies as $company)
                <div class="list-group-item">
                    <btn class="btn btn-default" onClick="showMap({{ $company->id }})">{{ $company->name }}</btn>
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
