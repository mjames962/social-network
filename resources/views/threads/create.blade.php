@extends('layouts.app')

@section('title', 'Create Thread')

@section('content')

<form method="POST" action="{{ route('threads.store') }}">

    @csrf

    <p>Title: <input type="text" name="title" value="{{ old('title') }}"></p>

    <p>Body: <textarea name="body" rows="5" cols="40">{{ old('body') }}</textarea></p>

    <input type="submit" value="Submit">

    <a href="{{ route('threads.index') }}">Cancel</a>

</form>
    
@endsection