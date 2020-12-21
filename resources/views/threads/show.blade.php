@extends('layouts.app')

@section('title', 'Thread Number: '. $thread->id)

@section('content')

    <h2>
        {{ $thread->title }}
    </h2>

    <p>
        {{ $thread->body }}
    </p>

@endsection