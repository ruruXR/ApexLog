@extends("layouts.layout")
@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                詳細画面
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>番号</th>
                            <td>{{$post->id}}</td>
                        </tr>
                        <tr>
                            <th>タイトル</th>
                            <td>{{$post->title}}</td>
                            <td>
                        </tr>
                        <tr>
                            <th>内容</th>
                            <td>{{$post->body}}</td>
                            <td>
                        </tr>
                    </tbody>
                </table>
                <a href="/" class="btn btn-info">戻る</a>
            </div>
        </div>
    </div>
</div>
@endsection