@extends('layouts.app')

@section('title', 'All Threads')

@section('content')
    
    <div class="row justify-content-center">
        <h2>
            <a href="{{ route('threads.create')  }}">Create Thread</a>
        </h2>
    </div>

    <div class="row justify-content-center">
        <ul>        
            @foreach ($threads as $thread)
                <li>
                    <a href="{{ route('threads.show', $thread->id) }}">{{ $thread->title }}</a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="row justify-content-center">    
        {!! $threads->links() !!}
    </div>

@endsection