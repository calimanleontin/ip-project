@extends('app')

@section('title')
    {{ $company->name }}
@endsection

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>

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

        @if(!Auth::guest() and Auth::user()->is_company() == true)
            <div class="panel-body">
                <div class="list-group">
                    <div class="list-group-item">
                        <h3>Add a comment:</h3>
                    </div>

                    <div class="list-group-item">
                        {!! Form::open(['url'=> '/comment-save']) !!}

                        <div class="form-group">
                            <textarea class="form-control" name="content" placeholder="Type..."></textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-default" value="Submit">
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endif


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