<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	// リレーション関係
    public function comments() {
		return $this->hasMany('App\Comment');
	}
	
	public function category() {
		return $this->belongsTo('App\Category');
	}
	
	public function user()
	{
      return $this->belongsTo('App\User');
	}
	
	public function getPaginateByLimit(int $limit_count = 10)
	{
		return $this->orderBy('updated_at','desc')->paginate($limit_count);
	}
	
	//任意のカテゴリーに属しているpostを探索
	public function scopeCategoryAt($query, $category_id)
	{
	    if (empty($category_id)) {
	        return;
	    }
	 
	    return $query->where('category_id', $category_id);
	}
	
	// 任意のwordが含まれているpostを探索
	public function scopeFuzzyNameMessage($query, $searchword)
	{
	    if (empty($searchword)) {
	        return;
	    }
	 
	    return $query->where(function ($query) use($searchword) {
	        $query->orWhere('name', 'like', "%{$searchword}%")
	              ->orWhere('message', 'like', "%{$searchword}%");
	    });
	}
	
	protected $fillable = [
		'name',
		'user_id',
        'subject',
        'message', 
        'category_id',
        'image_path'
		];
}