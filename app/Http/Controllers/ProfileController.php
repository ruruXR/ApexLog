<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use App\Category;
use Storage;

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
    
    public function edit(User $user)
    {
        return view('profileedit')->with(['user' => $user]);
    }
    
    public function update(Request $request,User $user)
    {
        // 画像が投稿された場合にs3に保存
        $image_path = null;
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $path = Storage::disk('s3')->putFile('', $image, 'public');
            $image_path = Storage::disk('s3')->url($path);   
        }
        
        $user_id = $user->id;
        
        // 保存
        $savedata = [
        'name' => $request->name,
        'description' => $request->description,
        'image_path' => $image_path,
        ];
        $user->fill($savedata)->save();
        return redirect()->route('profile.show',['user' => $user_id])->with('poststatus', 'プロフィールを編集しました');
    }
}
