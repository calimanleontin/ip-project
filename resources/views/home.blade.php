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
        <div class="list-group m0 reset-box-shadow">
            @foreach($companies as $company)
                <div class="list-group-item ip-list-group-item-companies reset-border-radius">
                    <ul class="list-inline m0 be-cleared">
                        <li class="lh32">
                            <a href="/company/{{ $company->slug }}"> View {{ $company->name }} web page.</a>
                        </li>
                        <li class="fr">
                            <btn class="btn ip-button primary-ip-button reset-border" data-toggle="modal" data-target="#myModal" onClick="showMap({{ $company->id }})">Show map</btn>
                        </li>
                    </ul>
                </div>
            @endforeach
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content ip-panel">
                    <div class="modal-header panel-heading">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">My map</h4>
                    </div>
                    <div class="modal-body">

                        <button class="btn ip-button primary-ip-button reset-border" id="calcRoute">Calc route</button>

                        <div id="map-canvas"></div>
                        <div id="overlay">
                            <div id="overlayContent">


                            </div>
                        </div>

                    </div>
                    <!--<div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>-->
                </div>

            </div>
        </div>


    <script src="/js/myLocation.js"></script>
    </div>

@endsection
