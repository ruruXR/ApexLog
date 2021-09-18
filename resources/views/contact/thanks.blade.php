@extends('layouts.layout')
 
@section('title', 'LaravelPjt BBS 投稿の一覧ページ')
@section('keywords', 'キーワード1,キーワード2,キーワード3')
@section('description', '投稿一覧ページの説明文')
@section('pageCss')
<link href="/css/bbs/style.css" rel="stylesheet">
@endsection
 
@include('layouts.header')
@section('content')
<h1>{{ __('送信完了') }}</h1>
@endsection
@include('layouts.footer')