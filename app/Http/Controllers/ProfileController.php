<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;

class ProfileController extends Controller
{
    public function profile (User $user) 
    {
        $posts = Post::with(['comments', 'category'])
        ->PostAt($user->id)
        ->Paginate(10);
        return view('profile')->with([
            'posts' => $posts,
            'user' => $user,
            ]); 
    }
}
