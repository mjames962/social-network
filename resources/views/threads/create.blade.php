@extends('layouts.app')

@section('title', 'Create Thread')

@section('content')

<form method="POST" action="{{ route('threads.store') }}" enctype="multipart/form-data">

    @csrf

    <p>Title: <input type="text" name="title" value="{{ old('title') }}"></p>

    <p>Body: <textarea name="body" rows="5" cols="40">{{ old('body') }}</textarea></p>

    <p>Tags: <input type="text" name="tagstring" value="{{ old('tagstring') }}"></p>

    <input type="file" name="image" />

    <input type="submit" value="Submit">

    <a href="{{ route('threads.index') }}">Cancel</a>

</form>
    
@endsection