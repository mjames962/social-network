<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Thread;
use App\Comment;
use App\User;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Thread $thread)
    {
        if(! Auth::check()) {
            session()->flash('message', 'Must be logged in to create comments.');
            return view('auth/login');
        }
        
        $id = auth()->user()->id;
        
        $validatedData = $request->validate([
            'body' => 'required|max:255',
        ]);
        
        $c = new Comment;
        $c->body = $validatedData['body'];
        $c->user_id = $id;
        $c->thread_id = $thread->id;
        $c->save();

        session()->flash('message', 'Comment Created.');
        return redirect()->route('threads.show', $thread);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit', ['comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        if (Auth::check() && Auth::id() == $comment->user_id) {
            
            $id = auth()->user()->id;
        
            $validatedData = $request->validate([
                'body' => 'required|max:255',
            ]);
            
            $comment->body = $validatedData['body'];
            $comment->save();

            session()->flash('message', 'Comment Edited.');
            return redirect()->route('threads.show', $comment->thread);
        } else {
            session()->flash('message', 'You can only edit your own threads.');
            return view('threads.show', ['thread' => $comment->thread]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $thread = $comment->thread;
        
        if (Auth::check() && Auth::id() == $comment->user_id) {
            $comment->delete();
            return redirect()->route('threads.show', $thread)->with('message', 'Comment Deleted.');
        } else {
            session()->flash('message', 'You can only delete your own comments.');
            return view('threads.show', ['thread' => $thread]);
        }
    }
}
