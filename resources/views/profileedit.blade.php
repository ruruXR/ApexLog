@extends('layouts.layout')
 
@section('title', 'ApexLog')
@section('keywords', 'Apex')
@section('description', '')
@section('pageCss')
<link href="/css/bbs/style.css" rel="stylesheet">
@endsection
 
@include('layouts.header')
 
@section('content')
<div class="container mt-4">
    <div class="border p-4">
        <h1 class="h4 mb-4 font-weight-bold">
            プロフィールの編集
        </h1>
 
        <form method="POST" action="/profile/{{ $user->id }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
 
            <fieldset class="mb-4">
 
                <div class="form-group">
                    <label for="subject">
                        名前
                    </label>
                    <input
                        id="name"
                        name="name"
                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        value="{{ old('name') ?: $user->name }}"
                        type="text"
                    >
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
 
                <div class="form-group">
                    <label for="description">
                        自己紹介
                    </label>
 
                    <textarea
                        id="description"
                        name="description"
                        class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                        rows="4"
                    >{{ old('description') ?: $user->description }}</textarea>
                    @if ($errors->has('description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                </div>
                
                <div class="form-group">
                    <label>
                        画像
                    </lavel>
                    <input 
                        type="file" 
                        name="image"
                    >
                </div>
 
                <div class="mt-5">
                    <a class="btn btn-secondary" href="/profile/{{ $user->id }}">
                        キャンセル
                    </a>
 
                    <button type="submit" class="btn btn-primary">
                        編集する
                    </button>
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
 
@include('layouts.footer')