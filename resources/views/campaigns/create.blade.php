@extends('app')
@section('title')
    Create new campaign
@endsection

@section('content')
	<form method="POST" action="/company/campaign/create" class="form-horizontal">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <label class="ip-color control-label col-sm-2" for="title">Titlu:</label>
            <div class="col-sm-4">
                <input type="text" name="title" class="form-control ip-input reset-border ip-button" id="title" placeholder="Title">
            </div>
        </div>

        <div class="form-group">
            <label class="ip-color control-label col-sm-2" for="start_date">Start date:</label>
            <div class="col-sm-4">
                <input type="text" name="start_date" class="form-control ip-input reset-border ip-button" id="start_date" placeholder="Start date">
            </div>
        </div>

        <div class="form-group">
            <label class="ip-color control-label col-sm-2" for="end_date">End date:</label>
            <div class="col-sm-4">
                <input type="text" name="start_date" class="form-control ip-input reset-border ip-button" id="end_date" placeholder="End date">
            </div>
        </div>

        <div class="col-sm-2">
            <input type="submit" class="form-control btn ip-button primary-ip-button reset-border" value="Creaza">
        </div>
    </form>
    <script type="text/javascript">
    	  $(function() {
		    $( "#start_date" ).datepicker();
		    $( "#end_date" ).datepicker();
		  });
    </script>
@endsection


