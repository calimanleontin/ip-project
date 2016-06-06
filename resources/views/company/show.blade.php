@extends('app')

@section('title')
    {{ $company->name }}
@endsection

@section('content')
        <div class="ip-color">
            <h3 class="ip-title-color">Description: </h3>
            @if(!empty($company->image))
                <img src="/images/companies/{{ $company->image }}"  class="company-image">
            @endif
            {!! $company->description !!}
            @if(!Auth::guest() and Auth::user()->is_company() == false)
                <h3 class="ip-title-color">Rate this company</h3>
                    <div class="list-group-item ip-list-group-item-companies reset-border-radius">
                        <ul class="list-inline m0 be-cleared">
                            <li class="fl">
                                <ul class="list-inline">
                                    @for ($i = 1; $i <= 10; $i++)
                                        <li>
                                            <div class="glyphicon glyphicon-star-empty" onmouseover="fullStar(this)" onmouseout="emptyStar(this)" ng-click="rateCompany({{ $company->id }}, {{ $i }})"></div>
                                        </li>
                                    @endfor
                                </ul>
                            </li>

                            <li class="lh29 fl">
                                Average grade : @{{ average }}
                            </li>

                            <li class="lh29 fl">
                                My grade : @{{ myGrade }}
                            </li>

                        </ul>
                    </div>
            @endif
            @if(!Auth::guest() and Auth::user()->is_company() == false)
                <h3 class="ip-title-color">Add a comment:</h3>
                <form class='form-group' ng-submit = 'submitComment("{{ $company->id }}")'>
                    <div class="form-group">
                        <textarea class="form-control" name="content" ng-model="commentData.content" placeholder="Type..."></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn ip-button primary-ip-button reset-border" value="Submit">
                    </div>
                </form>
            @endif
            <h3 class="ip-title-color">Comments:</h3>
        </div>
        <div class="" ng-hide="loading" ng-repeat="comment in comments">
            <div class="list-group reset-box-shadow ip-color">
                <div class="list-group-item ip-list-group-item-companies reset-border-radius reset-box-shadow">
                    By <strong>@{{comment.user.name}}</strong> on @{{ comment.created_at }}
                </div>
                <div class="list-group-item ip-list-group-item-companies reset-border-radius reset-box-shadow">
                    @{{ comment.content }}
                </div>
                @if(!Auth::guest() and Auth::user()->is_admin())
                    <div class="list-group-item">
                        <a href="" ng-click="deleteComment(comment.id)" class="text-muted">DeleteComment</a>
                    </div>
                @endif
            </div>
        </div>
@endsection