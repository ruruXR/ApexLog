<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;

class LikeController extends Controller
{
    // お気に入りに追加する
    public function like(Post $post)
    {
        Auth::user()->likePosts()->attach($post);
    }

    // お気にいりを外す
    public function unlike(Post $post)
    {
        Auth::user()->likePosts()->detach($post);
    }
}
