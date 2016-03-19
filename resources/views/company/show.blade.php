@extends('app')

@section('title')
    {{ $company->name }}
@endsection

@section('content')
    <div class="">
        <div class="panel-body">

            <div class="list-group">
                @if(!empty($company->image))
                    <div class="list-group-item">
                        <img src="/images/companies/{{ $company->image }}"  class="img-company">
                    </div>
                @endif
            </div>
            <div class="list-group">
                <div class="list-group-item">
                    <h3>Description: </h3>{!! $company->description !!}
                </div>
            </div>
        </div>

        <div class="panel-body">
            <div class="list-group">
                <div class="list-group-item">
                    <h3>Comments:</h3>
                </div>
            </div>


            @if(!empty($company->comments))
                @foreach($companies as $company)
                    <div class="list-group">
                        <div class="list-group-item">
                            By <small>{{ $comment->user->name }}</small> on {{ $comments->created_at }}
                        </div>
                        <div class="list-group-item">
                            {!! $comment->content !!}
                        </div>
                    </div>
                @endforeach
                @else
                <div class="list-group-item">
                    Sorry, no comments.
                </div>
            @endif
        </div>
    </div>
@endsection