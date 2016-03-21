@extends('app')
@section('title')
    @if(!empty($title))
        {{$title}}
    @else
        My location
    @endif
@endsection

@section('content')
    <script src="/js/myLocation.js"></script>

    <div class="">
            <a href="#" id="showMyLocation">Where Am I</a>
    </div>
@endsection
