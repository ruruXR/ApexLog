@extends('layouts.layout')
 
@section('title', 'ApexLog')
@section('keywords', 'Apex')
@section('description', '')
@section('pageCss')
<!--<link href="/css/bbs/style.css" rel="stylesheet">-->
<script src="{{ mix('js/app.js') }}" defer></script>
@endsection
 
@include('layouts.header')
 
@section('content')
<div class="container mt-4">
    <div class="border p-4">
        <div id="app">
            <div class="mb-4 text-right">
                @can('isAdmin')
                    <a href="/" class="btn btn-secondary">一覧</a>
                    <form
                    style="display: inline-block;"
                    method="POST"
                    action="/posts/{{ $post->id }}"
                    >
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">削除</button>
                    </form>
                @else
                    @auth
                        @if(Auth::id() === $post->user_id)
                            <a href="{{ $url }}" class="btn btn-secondary">一覧</a>
                            <a href="/posts/{{ $post->id }}/edit" class="btn btn-info">
                                編集
                            </a>
                            <form
                            style="display: inline-block;"
                            method="POST"
                            action="/posts/{{ $post->id }}"
                            >
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">削除</button>
                            </form>
                        @else
                            <a href="{{ $url }}" class="btn btn-secondary">一覧に戻る</a>
                            <like-component :post-id="{{ $post->id }}" :liked-data="{{ $likePosts  }}"></like-component>
                　　      @endif
                    @endauth
                    @guest
                        <a href="{{ $url }}" class="btn btn-secondary">一覧</a>
                    @endguest
                @endcan
            </div>
        </div>
        <!-- 件名 -->
        <h1 class="h4 mb-4">
            {{ $post->subject }}
        </h1>
 
        <!-- 投稿情報 -->
        <div class="summary">
            <p><span>{{ $post->name }}</span> / <time>{{ $post->updated_at->format('Y.m.d H:i') }}</time> / {{ $post->category->name }} / {{ $post->id }}</p>
        </div>
 
        <!-- 本文 -->
        <p class="mb-5">
            {!! nl2br(e($post->message)) !!}
        </p>
        
        <!-- 画像表示　-->
        @if ($post->image_path)
            <img src="{{ $post->image_path }}" class="img-fluid">
        @endif
 
        <section>
            @if (session('commentstatus'))
                <div class="alert alert-success mt-4 mb-4">
                 {{ session('commentstatus') }}
                </div>
            @endif
            <h2 class="h5 mb-4">
                コメント
            </h2>
 
            @forelse($post->comments as $comment)
                <div class="border-top p-4">
                    <time class="text-secondary">
                        {{ $comment->name }} / 
                        {{ $comment->created_at->format('Y.m.d H:i') }} / 
                        {{ $comment->id }}
                    </time>
                    <p class="mt-2">
                        {!! nl2br(e($comment->comment)) !!}
                    </p>
                </div>
            @empty
                <p>コメントはまだありません。</p>
            @endforelse
            
            <form class="mb-4" method="POST" action="/comments">
                @csrf
                <input
                    name="post_id"
                    type="hidden"
                    value="{{ $post->id }}"
                >
                
                <input
                    name="url"
                    type="hidden"
                    value="{{ $url }}"
                >
             
                <div class="form-group">
                    <label for="subject">
                    名前
                    </label>
             
                <input
                    id="name"
                    name="name"
                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                    value="{{ old('name') }}"
                    type="text"
                >
                @if ($errors->has('name'))
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
                @endif
                </div>
             
                <div class="form-group">
                 <label for="body">
                 本文
                 </label>
             
                    <textarea
                        id="comment"
                        name="comment"
                        class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}"
                        rows="4"
                    >{{ old('comment') }}</textarea>
                    @if ($errors->has('comment'))
                     <div class="invalid-feedback">
                     {{ $errors->first('comment') }}
                     </div>
                    @endif
                </div>
             
                <div class="mt-4">
                 <button type="submit" class="btn btn-primary">
                 コメントする
                 </button>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection
@include('layouts.footer')