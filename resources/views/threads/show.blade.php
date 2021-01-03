@extends('layouts.app')

@section('title', 'Thread Number: '. $thread->id)

@section('content')
    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ $thread->title }} ({{ $thread->created_at }})</div>
                <div class="card-body">
                    @if ($thread->tags->first() != null)
                        Tags: 
                        @foreach ($thread->tags as $tag)
                            {{ $tag->name }},      
                        @endforeach   
                    @endif
                    <p>Posted by {{ $thread->user->name }}</p>
                    <p>
                        @if ($thread->image != null)
                            <img src="{{ asset('/storage/images/'.$thread->image) }}" alt="{{ $thread->image }}" width="200" />
                        @endif
                    </p>
                    {{ $thread->body }}
                    @if(Auth::check())
                        @if (auth()->user()->hasAdminProfile || auth()->user()->id == $thread->user_id)
                            <form action="{{ route('threads.destroy', $thread->id) }}" method="POST">
                                @csrf
                                <a href="{{ route('threads.edit', $thread) }}">Edit</a>
                                @method('DELETE')
                                <button type="submit" class="btn btn-tertiary">Delete</button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

    
        
@foreach ($thread->comments as $comment) 
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">{{ $comment->user->name }} ({{ $comment->created_at }})</div>
                    <div class="card-body">
                        
                        <p>{{ $comment->body }}</p>

                        @if(Auth::check())
                            @if (auth()->user()->hasAdminProfile || auth()->user()->id == $comment->user_id)
                            <a href="{{ route('comments.edit', $comment) }}">Edit</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
    
    @if (Auth::check())  
        <br>
        <div>
            <h4> Comment </h4>
            
            <form method="POST" action="{{ route('comments.store', $thread) }}">

                @csrf
            
                <p><textarea name="body" rows="5" cols="40">{{ old('body') }}</textarea></p>
            
                <input type="submit" value="Submit" class="btn btn-primary">
            
                <a href="{{ route('threads.show', $thread) }}">Cancel</a>
            
            </form>
        </div>
    @endif


@endsection