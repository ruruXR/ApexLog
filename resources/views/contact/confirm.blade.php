@extends('layouts.layout')
 
@section('title', 'LaravelPjt BBS 投稿の一覧ページ')
@section('keywords', 'キーワード1,キーワード2,キーワード3')
@section('description', '投稿一覧ページの説明文')
@section('pageCss')
<link href="/css/bbs/style.css" rel="stylesheet">
@endsection
 
@include('layouts.header')
@section('content')
<form method="POST" action="{{ route('contact.send') }}">
    @csrf

    <label>メールアドレス</label>
    {{ $inputs['email'] }}
    <input
        name="email"
        value="{{ $inputs['email'] }}"
        type="hidden">

    <label>タイトル</label>
    {{ $inputs['title'] }}
    <input
        name="title"
        value="{{ $inputs['title'] }}"
        type="hidden">


    <label>お問い合わせ内容</label>
    {!! nl2br(e($inputs['body'])) !!}
    <input
        name="body"
        value="{{ $inputs['body'] }}"
        type="hidden">

    <button type="submit" name="action" value="back">
        入力内容修正
    </button>
    <button type="submit" name="action" value="submit">
        送信する
    </button>
</form>
@endsection
@include('layouts.footer')