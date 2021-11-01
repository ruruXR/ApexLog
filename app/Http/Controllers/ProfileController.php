<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;

class ProfileController extends Controller
{
    public function profile (Repuest $repuest) 
    {
        $user_id = $repuest->user_id;
        $user = User::find($user_id);
        $posts = Post::with(['comments', 'category'])
        ->PostAt($user_id)
        ->Paginate(10);
        return view('profile')->with([
            'posts' => $posts,
            'user' => $user,
            ]); 
    }
}
