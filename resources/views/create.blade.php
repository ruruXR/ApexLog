@extends("layouts.layout")
@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                登録画面
            </div>
            <div class="card-body">
                <form method="POST" action="/posts">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="control-label">タイトル</label>
                        <input class="form-control" name="post[title]" type="text" value="{{ old('post.title') }}"/>
                    </div>
                    <div>
                        <label for="body" class="control-label">内容</label>
                        <input class="form-control" name="post[body]" type="text">
                    </div>
                    <button class="btn btn-primary" type="submit" value="send">登録</button>
                </form>
                <div class="back">[<a href="/">back</a>]</div>
            </div>
        </div>
    </div>
</div>
@endsection