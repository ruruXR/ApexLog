@extends('layouts.layout')
 
@section('title', 'LaravelPjt BBS 投稿の一覧ページ')
@section('keywords', 'キーワード1,キーワード2,キーワード3')
@section('description', '投稿一覧ページの説明文')
@section('pageCss')
<link href="/css/bbs/style.css" rel="stylesheet">
@endsection
 
@include('layouts.header')
@section('content')
<form method="POST" action="{{ route('contact.confirm') }}">
    @csrf

    <label>メールアドレス</label>
    <input
        name="email"
        value="{{ old('email') }}"
        type="text">
    @if ($errors->has('email'))
        <p class="error-message">{{ $errors->first('email') }}</p>
    @endif

    <label>タイトル</label>
    <input
        name="title"
        value="{{ old('title') }}"
        type="text">
    @if ($errors->has('title'))
        <p class="error-message">{{ $errors->first('title') }}</p>
    @endif


    <label>お問い合わせ内容</label>
    <textarea name="body">{{ old('body') }}</textarea>
    @if ($errors->has('body'))
        <p class="error-message">{{ $errors->first('body') }}</p>
    @endif

    <button type="submit">
        入力内容確認
    </button>
</form>
@endsection
@include('layouts.footer')