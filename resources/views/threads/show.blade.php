@extends('layouts.app')

@section('title', 'Thread Number: '. $thread->id . ' ('. $thread->created_at . ')')

@section('content')
    
    <h2>
       {{ $thread->title }}
    </h2>

    <p>{{ $thread->body }}</p>

    <form action="{{ route('threads.destroy', $thread->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>

    @foreach ($thread->comments as $comment)    
        <div>
            <br>
            <p>{{ $comment->created_at }}</p>
            <p>{{ $comment->body }}</p>
        </div>
    @endforeach

@endsection