@extends('layouts.layout')
 
@section('title', 'ApexLog')
@section('keywords', 'Apex')
@section('description', '')
@section('pageCss')
<!--<link href="/css/bbs/style.css" rel="stylesheet">-->
@endsection
 
@include('layouts.header')
 
@section('content')
<div class="nav-scroller">
    <nav class="nav d-flex justify-content-between">
        @foreach($categories as $id => $name)
            <a class="p-2 text-muted" href="/?category_id={{ $id }}">{{ $name }}</a>
        @endforeach
    </nav>
</div>

<div class="d-flex flex-row mt-4 mb-4">
    <div class="p-2 bd-highlight">
    <form class="form-inline" method="GET" action="/">
        <div class="form-group">
            <input type="text" name="searchword" value="{{$searchword}}" class="form-control" placeholder="名前を検索">
        </div>
        <input type="submit" value="検索" class="btn btn-info ml-2">
    </form>
    </div>
    <div class="p-2 bd-highlight">
        <a class="btn btn-info ml-2" href="/?post_id={{ $user_id }}">自分の投稿</a>
    </div>
        
        
</div>

@if (session('poststatus'))
    <div class="alert alert-success mt-4 mb-4">
        {{ session('poststatus') }}
    </div>
@endif


<div class="row mb-2">
    @foreach ($posts as $post)
        <div class="col-md-6">
            <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                <div class="card-body d-flex flex-column align-items-start">
                    <strong class="d-inline-block mb-2 text-primary">{{ $post->category->name }}</strong>
                    <h3 class="mb-0">
                    <a class="text-dark" href="/posts/{{ $post->id }}">{{ $post->subject }}</a>
                    </h3>
                    <div class="mb-1 text-muted">{{ $post->name }}が{{ $post->created_at->format('Y.m.d') }}に投稿</div>
                    <p class="card-text ml-auto">{!! nl2br(e(Str::limit($post->message, 50))) !!}</p>
                    <p><span class="badge badge-primary">コメント：{{ $post->comments->count() }}件</span></p>
                </div>
                @if($post->image_path==null)
                    <img class="card-img-right flex-auto d-none d-lg-block" style="width: 200px; height: 250px;" src="https://bbs-backet.s3.ap-northeast-1.amazonaws.com/ROQCH01h3Zx72NhHeYdqUgLWMFQg1yTfxPmddyQP.jpg"></img>
                @else
                    <img class="card-img-right flex-auto d-none d-lg-block" style="width: 200px; height: 250px;" src="{{ $post->image_path }}"></img>
                @endif
            </div>
        </div>
    @endforeach
</div>
<div class='d-flex justify-content-center'>
    {{ $posts->appends(request()->query())->links() }}
</div> 
@endsection
 
@include('layouts.footer')