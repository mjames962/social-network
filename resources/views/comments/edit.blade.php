@extends('layouts.app')

@section('title', 'Edit Comment')

@section('content')

<form method="POST" action="{{ route('comments.update', $comment) }}">

    @csrf

    <p><textarea name="body" rows="5" cols="40">{{ $comment->body }}</textarea></p>

    <input type="submit" class ="btn btn-primary" value="Submit">

    <form action="{{ route('comments.destroy', $comment) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-secondary">Delete</button>
    </form>
    
    <a href="{{ route('threads.show', $comment->thread) }}">Cancel</a>

</form>
    
@endsection