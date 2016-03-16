@extends('app')

@section('title')
    Edit
@endsection


<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>

@section('content')
    <div class="">
        <div class="form-group">

            {!! Form::open(array('url' => '/company/update', 'files' => true, 'class' => 'form-group')) !!}

            <div class="form-group col-md-5">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', $user->name, array('class' => 'form-control', 'required', 'placeholder' => 'Name')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description:') !!}
                {!! Form::textarea('description', $company->description, array('class' => 'form-control', 'required', 'placeholder' => 'Description')) !!}
            </div>


            {!! Form::close() !!}

        </div>

    </div>


@endsection