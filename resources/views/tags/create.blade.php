@extends('app')
@section('title')
    Add New Tag
@endsection
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>

@section('content')
    <form action="/store-tag" method="post">
        <label for="name">Name:</label>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <input required="required" value="{{ old('name') }}" placeholder="Enter tag name" type="text" name = "name "class="form-control" />
        </div>
        <label for="description">Description:</label>
        <div class="form-group">
            <textarea name='description'class="form-control">{{ old('description') }}</textarea>
        </div>

        <input type="submit" name='publish' class="btn btn-default" value = "Create"/>
    </form>
@endsection