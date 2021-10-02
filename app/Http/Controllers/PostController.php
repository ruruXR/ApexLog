<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\User;
use Storage;
use Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest; 
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $category = new Category;
        $categories = $category->getList();
        $category_id = $request->category_id;
        $searchword = $request->searchword;
        $post_id = $request->post_id;
        $user_id = Auth::id();
        $posts = Post::with(['comments', 'category'])
        ->categoryAt($category_id)
        ->fuzzyNameMessage($searchword)
        ->PostAt($post_id)
        ->paginate(10);
        return view('index')->with([
            'posts' => $posts,
            'categories' => $categories,
            'category_id' => $category_id,
            'searchword' => $searchword,
            'user_id' => $user_id,
            ]);
    }

    public function show(Post $post)
    {
        $url = url()->previous();
        $user_id = Auth::id();
        if($user_id == null){
            return view('show')->with([
            'post' => $post,
            'url' => $url,
            ]);
        }else{
        $likePosts = Auth::user()->likePosts()->pluck('post_id');
        return view('show')->with([
            'post' => $post,
            'likePosts' => $likePosts,
            'url' => $url,
            ]);
        }
    }
    public function create ()
    {
        $category = new Category;
        $categories = $category->getList()->prepend('選択'.'');
        return view('create')->with(['categories' => $categories]);
    }
    public function store(PostRequest $request,Post $post) 
    {
        $image_path = null;
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $path = Storage::disk('s3')->putFile('', $image, 'public');
            $image_path = Storage::disk('s3')->url($path);   
        }
        $user_id = Auth::id();
        $savedata = [
        'name' => $request->name,
        'user_id' => $user_id,
        'subject' => $request->subject,
        'message' => $request->message,
        'category_id' => $request->category_id,
        'image_path' => $image_path,
        ];
        $post->fill($savedata)->save();
     
        return redirect('/')->with('poststatus', '新規投稿しました');
    }
    public function edit(Post $post)
    {
        $category = new Category;
        $categories = $category->getList();
        $this->authorize('edit', $post);
        return view('edit')->with(['post' => $post,'categories' => $categories]);
    }
    public function update(PostRequest $request,Post $post)
    {
        $image_path = null;
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $path = Storage::disk('s3')->putFile('', $image, 'public');
            $image_path = Storage::disk('s3')->url($path);   
        }
        $user_id = Auth::id();
        $savedata = [
        'name' => $request->name,
        'user_id' => $user_id,
        'subject' => $request->subject,
        'message' => $request->message,
        'category_id' => $request->category_id,
        'image_path' => $image_path,
        ];
        $post->fill($savedata)->save();
        return redirect('/')->with('poststatus', '投稿を編集しました');
    }
    public function destroy(Post $post)
    {
        if(Gate::allows('isAdmin')){
            $post->comments()->delete();
            $post->delete();
            return redirect('/')->with('poststatus', '投稿を削除しました');;
        }else{
            $this->authorize('delete', $post);
            $post->comments()->delete();
            $post->delete();
            return redirect('/')->with('poststatus', '投稿を削除しました');;
        }
    }
}