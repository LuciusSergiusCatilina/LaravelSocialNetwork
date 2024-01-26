<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\Request;
use App\Models\Idea;
use App\Models\Comment;




class CommentController extends Controller
{
    public function store(StoreCommentRequest $request ,Idea $idea){
        // $comment = new Comment();
        // $comment->idea_id = $idea->id;
        // $comment->user_id = auth()->id();
        // $comment->content = request()->get('content','');
        // $comment->save();

        $validated = $request->validate();
        $validated['idea_id']  = $idea->id;
        $validated['user_id'] = auth()->id();
        Comment::create($validated);
        return redirect()->route('dashboard')->with('success', 'Idea created!');
    }


}
