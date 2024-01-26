<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
        //$ideas = Idea::orderBy('created_at', 'DESC');


        // if (request()->has('search')){
        //     $ideas = $ideas->search(request('search')); //scopeSearch mi ispolzuem tolko search :)
        // }
        // or use that sintax:

        $ideas =Idea::when(request()->has('search'), function($query){
            $query->search(request('search'));
        }) ->orderBy('created_at', 'DESC')->paginate(3);

        //  $topUsers = User::withCount('ideas')->orderBy('ideas_count','DESC')->limit(5)->get();

        return view('dashboard',[
            'ideas' =>$ideas
            // 'topUsers'=> $topUsers,
        ]);
    }
}
