<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use Illuminate\Http\Request;
use App\Models\Idea;
use Illuminate\Support\Facades\Cache;

class IdeaController extends Controller
{

    public function show(Idea $idea){
        return view('ideas.show',compact('idea'));
    }


    public function store(StoreIdeaRequest $request){
        Cache::forget('topUsers');
        $validated = $request->validated();

        $validated['user_id'] = auth()->id();
        Idea::create($validated);
        return redirect()->route('dashboard')->with('success', 'Idea created!');
    }

    public function destroy(Idea $idea){
        // if(auth()->id() !== $idea->user_id){
        //     abort(404);
        // }

        // $this->authorize('idea.delete',$idea);

        Cache::forget('topUsers');
        $this->authorize('delete',$idea);
        $idea->delete();
        return redirect()->route('dashboard')->with('success', 'Idea deleted!');
    }

    public function edit(Idea $idea){
        // if(auth()->id() !== $idea->user_id){
        //     abort(404);
        // }

        // $this->authorize('idea.edit',$idea); GATES
        $this->authorize('update',$idea); //POLICY
        $editing = true;
        return view('ideas.show',compact('idea','editing'));
    }

    public function update(UpdateIdeaRequest $request, Idea $idea){

        // $this->authorize('idea.edit',$idea);
        $this->authorize('update',$idea);

        $validated = $request->validated();
        $idea->update($validated);
        return redirect()->route('ideas.show',$idea->id)->with('success','Idea updated!');
    }
}
