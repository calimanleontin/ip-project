@extends('app')

@section('title')
    {{ $profile->user->name }}
    @if(!Auth::guest() and Auth::user()->id == $profile->user->id)
        <small><small><a href="/edit-profile">Edit Profile</a></small></small>
    @endif
@endsection

@section('content')
    <div class="">
        <div class="panel-body">
            <div class="list-group">
                @if(!empty($profile->avatar))
                    <div class="list-group-item">
                        <img src="{{ $profile->avatar }}">
                    </div>
                @endif

                <div class="list-group-item">
                    Restul de elemente sau/si ce mai vrei.
                </div>
            </div>
        </div>
    </div>
@endsection