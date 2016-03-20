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

        @if(!Auth::guest() and Auth::user()->is_company() == false)
            <div class="panel-body">
                <div class="list-group">
                    <div class="list-group-item">
                        <h3>Add a comment:</h3>
                    </div>

                    <div class="list-group-item">
                        <form class='form-group' ng-submit = 'submitComment("{{ $company->id }}")'>

                            <div class="form-group">
                                <textarea class="form-control" name="content" ng-model="commentData.content" placeholder="Type..."></textarea>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-default" value="Submit">
                            </div>

                        </form>
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

            <div class="" ng-hide="loading" ng-repeat="comment in comments">
                <div class="list-group">
                    <div class="list-group-item">
                        By <small>@{{comment.user.name}}</small> on @{{ comment.created_at }}
                    </div>
                    <div class="list-group-item">
                        @{{ comment.content }}
                    </div>
                    @if(!Auth::guest() and Auth::user()->is_admin())
                        <div class="list-group-item">
                            <a href="" ng-click="deleteComment(comment.id)" class="text-muted">DeleteComment</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection