@extends('layouts.app')

@section('title', 'Edit Thread')

@section('content')

<form method="POST" action="{{ route('threads.update', $thread->id) }}">

    @csrf

    <p>Title: <input type="text" name="title" value="{{ $thread->title }}"></p>

    <p>Body: <textarea name="body" rows="5" cols="40">{{ $thread->body }}</textarea></p>

    <input type="submit" value="Submit">

    <a href="{{ route('threads.show', $thread) }}">Cancel</a>

</form>
    
@endsection