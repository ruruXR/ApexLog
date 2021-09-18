<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function Comments() {
		// 投稿はたくさんのコメントを持つ
		return $this->hasMany('App/Comment');
	}
	
	public function Category() {
		return $this->belongTo('App/Category');
	}
}