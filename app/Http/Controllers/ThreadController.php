<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Thread;
use App\User;
use App\Tag;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $threads = Thread::paginate(10);
        return view('threads.index',compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if(! Auth::check()) {
            session()->flash('message', 'Must be logged in to create threads.');
            return view('auth/login');
        }
        
        $id = auth()->user()->id;
        
        $tags = $request->tagstring;
        $tagArray = explode(',', $tags);
        
        $validatedData = $request->validate([
            'title' => 'required|max:50',
            'body' => 'required|max:255',
        ]);
        
        $t = new Thread;
        $t->title = $validatedData['title'];
        $t->body = $validatedData['body'];
        $t->user_id = $id;
        
        if($request->hasFile('image')) {
           $filename = $request->image->getClientOriginalName();
           $request->image->storeAs('images', $filename, 'public');
           $t->image = $filename;
        }
        
        $t->save();

        foreach ($tagArray as $string) {
            if($string !== "") {
                $tag = Tag::create(['name' => $string]);
                $t->tags()->save($tag);
            }   
        }

        session()->flash('message', 'Thread Created.');
        return redirect()->route('threads.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Thread $thread)
    {
        return view('threads.show', ['thread' => $thread]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        return view('threads.edit', ['thread' => $thread]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        if (Auth::check() && Auth::id() == $thread->user_id) {
            
            $id = auth()->user()->id;
        
            $validatedData = $request->validate([
                'title' => 'required|max:50',
                'body' => 'required|max:255',
            ]);
            
            $thread->title = $validatedData['title'];
            $thread->body = $validatedData['body'];
            $thread->save();

            session()->flash('message', 'Thread Edited.');
            return redirect()->route('threads.show', $thread);
        } else {
            session()->flash('message', 'You can only edit your own threads.');
            return view('threads.show', ['thread' => $thread]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        if (Auth::id() == $thread->user_id) {
            $thread->delete();
            return redirect()->route('threads.index')->with('message', 'Thread Deleted.');
        } else {
            session()->flash('message', 'You can only delete your own threads.');
            return view('threads.show', ['thread' => $thread]);
        }
        
    }
}
