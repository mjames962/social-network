@extends('layouts.app')

@section('title', 'Thread Number: '. $thread->id)

@section('content')
    
    <div>
        <h2>
        {{ $thread->title }} ({{ $thread->created_at }})
        </h2>

        <p>{{ $thread->user->name }}</p>
        <p>{{ $thread->body }}</p>

        @if (auth()->user()->id == $thread->user_id)
            <form action="{{ route('threads.edit', $thread->id) }}" method="GET">
                <button type="submit" class="btn btn-primary">Edit</button>
            </form> 
            <form action="{{ route('threads.destroy', $thread->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-secondary">Delete</button>
            </form>
        @endif  
    </div>
    
        @foreach ($thread->comments as $comment)    
        <br>
        <div>
            <p>{{ $comment->user->name }}   -   {{ $comment->created_at }}</p>
            <p>{{ $comment->body }}</p>
        </div>
    @endforeach

@endsection