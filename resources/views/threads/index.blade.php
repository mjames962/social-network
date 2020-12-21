@extends('layouts.app')

@section('title', 'All Threads')

@section('content')
    <ul>
        @foreach ($threads as $thread)
    
            <li>
                <a href="{{ route('threads.show', $thread) }}">{{ $thread->title }}</a>
            </li>
        
        @endforeach
    
    </ul>

@endsection