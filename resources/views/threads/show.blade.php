@extends('layouts.app')

@section('title', 'Thread Number: '. $thread->id)

@section('content')
    
    <div>
        <h2>
        {{ $thread->title }} ({{ $thread->created_at }})
        </h2>

        <h4>
            @if ($thread->tags->first() != null)
                Tags: 
                @foreach ($thread->tags as $tag)
                    {{ $tag->name }},      
                @endforeach   
            @endif     
        </h4>

        <p>Posted by {{ $thread->user->name }}</p>
        <p>
            @if ($thread->image != null)
                <img src="{{ asset('/storage/images/'.$thread->image) }}" alt="{{ $thread->image }}" width="200" />
            @endif
            
            {{ $thread->body }}
        </p>

        @if(Auth::check())
            @if (auth()->user()->hasAdminProfile || auth()->user()->id == $thread->user_id)
                    <form action="{{ route('threads.destroy', $thread->id) }}" method="POST">
                        @csrf
                        <a href="{{ route('threads.edit', $thread) }}">Edit</a>
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
            @endif
        @endif
    </div>
    
        @foreach ($thread->comments as $comment)    
        <br>
        <div>
            <p>{{ $comment->user->name }}   -   {{ $comment->created_at }}</p>
            <p>{{ $comment->body }}</p>

            @if(Auth::check())
                @if (auth()->user()->hasAdminProfile || auth()->user()->id == $comment->user_id)
                    <form action="{{ route('comments.edit', $comment) }}" method="GET">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </form> 
                @endif
            @endif

        </div>
    @endforeach

    

    @if (Auth::check())  
        <br>
        <div>
            <h4> Comment </h4>
            
            <form method="POST" action="{{ route('comments.store', $thread) }}">

                @csrf
            
                <p><textarea name="body" rows="5" cols="40">{{ old('body') }}</textarea></p>
            
                <input type="submit" value="Submit">
            
                <a href="{{ route('threads.show', $thread) }}">Cancel</a>
            
            </form>
        </div>
    @endif


@endsection