@extends('layouts.app')

@section('title', 'All Threads')

@section('content')
    
    <h2>
        <a href="{{ route('threads.create')  }}">Create Thread</a>
    </h2>

    <ul>
        @foreach ($threads as $thread)
    
            <li>
                <a href="{{ route('threads.show', $thread->id) }}">{{ $thread->title }}</a>
            </li>
        
        @endforeach
    
    </ul>

@endsection