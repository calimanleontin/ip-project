@extends('app')
@section('title')
    View campaign
@endsection

@section('content')
    <div class="panel-body">
        <div>Campaign: {{ $campaign->title }}</div>
        <div>Start date: {{ $campaign->start }}</div>
        <div>End date: {{ $campaign->end }}</div>
        @if (!empty($winners))
            <div>
                <h5>Winners:</h5>
                <ul>
                    @foreach ($winners as $key => $winner)
                        <li>{{ !empty($winner['place']) ? $winner['place'] : $key + 1 }}. {{ $winner['name'] }} ({{ $winner['email'] }})</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection


