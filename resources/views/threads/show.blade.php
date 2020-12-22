@extends('layouts.app')

@section('title', 'Thread Number: '. $thread->id . ' ('. $thread->created_at . ')')

@section('content')
    
    <h2>
       {{ $thread->title }}
    </h2>

    <p>{{ $thread->body }}</p>

    @foreach ($thread->comments as $comment)    
        <br>
        <p>{{ $comment->created_at }}</p>
        <p>{{ $comment->body }}</p>
    @endforeach

@endsection