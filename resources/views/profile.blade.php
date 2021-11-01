@extends('layouts.layout')
 
@section('title', 'ApexLog')
@section('keywords', 'Apex')
@section('description', '')
@section('pageCss')
<!--<link href="/css/bbs/style.css" rel="stylesheet">-->
@endsection
 
@include('layouts.header')
 
@section('content')
@if (session('poststatus'))
    <div class="alert alert-success mt-4 mb-4">
        {{ session('poststatus') }}
    </div>
@endif
<div class="row jumbotron p-3 p-md-5 text-white rounded bg-dark">
    <div class="col-md-6 px-0">
        <img src="{{ $user->image_path }}" class="img-fluid mx-auto d-block">
    </div>
    <div class="col-md-6 px-0">
        <h1 class="display-4 font-italic">{{ $user->name }}</h1>
        <p class="lead my-3">{{ $user->description }}</p>
    </div>
</div>
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
                    <p class="card-text ml-auto">{!! nl2br(e(Str::limit($post->message, 40))) !!}</p>
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