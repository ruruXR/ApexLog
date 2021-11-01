<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use App\Category;

class ProfileController extends Controller
{
    public function profile (User $user,Request $request) 
    {
        $category = new Category;
        $categories = $category->getList();
        
        // 検索に使う情報の取得
        $category_id = $request->category_id;
        $searchword = $request->searchword;
        $user_id = $request->user_id;
        
        $posts = Post::with(['comments', 'category'])
        ->categoryAt($category_id)
        ->fuzzyNameMessage($searchword)
        ->PostAt($user->id)
        ->Paginate(10);
        
        return view('profile')->with([
            'posts' => $posts,
            'categories' => $categories,
            'category_id' => $category_id,
            'searchword' => $searchword,
            'user' => $user,
            ]);
    }
}
