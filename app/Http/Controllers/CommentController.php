<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Comment;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        $savedata = [
            'post_id' => $request->post_id,
            'name' => $request->name,
            'comment' => $request->comment,
        ];
        $url = $request->url;
        $request->session()->put('key', 'value');
        $request->session()->put(['url' => $url]);
        $commentstatus = 'コメントを投稿しました';
 
        $comment = new Comment;
        $comment->fill($savedata)->save();
 
        return redirect()->route('show', [$savedata['post_id']])->with([
            'commentstatus' => $commentstatus,
            ]);
    }
}
