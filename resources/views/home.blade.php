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
        <button id="calcRoute">Calc route</button>

        <div id="map-canvas"></div>
        <div id="overlay">
            <div id="overlayContent">


            </div>
        </div>
    <script src="/js/myLocation.js"></script>
    </div>

@endsection
