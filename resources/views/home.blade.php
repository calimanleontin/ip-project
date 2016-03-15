@extends('app')
@section('title')
    @if(!empty($title))
        {{$title}}
    @else
        Sorry.
    @endif
@endsection
@section('content')
    <div class="">
        @if(!empty($items))
            @foreach( $items as $item )
                <div class="list-group">
                    <div class="list-group-item">
                        ceva
                    </div>
                    <div class="list-group-item">
                        altceva
                    </div>
                </div>
            @endforeach
        @else
            No articles or anything.
        @endif
    </div>
@endsection