@extends('app')
@section('title')
    Campaigns
@endsection

@section('content')
    <div class="panel-body">
        @if (!empty($campaigns))
            <div class="list-group m0 reset-box-shadow">
                @foreach ($campaigns as $key => $campaign)
                    <div class="list-group-item ip-list-group-item-companies reset-border-radius">
                        <ul class="list-inline m0 be-cleared">
                            <li class="lh32">
                                <h4>
                                    <a href="/campaigns/{{ $campaign->id }}">{{ $campaign->title }}</a>
                                </h4>
                                <span>Starts: {{ $campaign->start }}</span>
                                <span>Ends: {{ $campaign->end }}</span>
                            </li>
                        </ul>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection


