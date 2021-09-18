@extends('layouts.layout')
@section('content')

<div class="col-xs-8 col-xs-offset-2">
	@foreach($post as $post)
	<h2>タイトル：{{ $posts->title }}
	<small>投稿日：{{ date("y/m/d",strtotime($post->created_at)) }}</small>
	</h2>
	<p>カテゴリー：{{ $post->category->name }}</p>
	<p>{{ $post->content }}</p>
	<p href="/{post->id" class="btn btn-primary">続きを読む</p>
	<p>コメント数：{{ $post->comment_count }}</p>
	<hr />
@endforeach

</div>

@stop