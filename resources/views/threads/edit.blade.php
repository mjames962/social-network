@extends('layouts.app')

@section('title', 'Edit Thread')

@section('content')

<div class="row justify-content-center">
    <form method="POST" action="{{ route('threads.update', $thread->id) }}">

        @csrf

        <p>Title: <input type="text" name="title" value="{{ $thread->title }}"></p>

        <p>Body: <textarea name="body" rows="5" cols="40">{{ $thread->body }}</textarea></p>

        <input type="submit" value="Submit" class="btn btn-primary">

        <a href="{{ route('threads.show', $thread) }}">Cancel</a>

    </form>
</div>
    
@endsection