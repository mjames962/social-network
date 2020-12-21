@extends('layouts.app')

@section('title', 'All Threads')

@section('content')
    <ul>
        @foreach ($threads as $thread)
            <li>{{ $thread->title }}</li>
        
        @endforeach
    
    </ul>

@endsection