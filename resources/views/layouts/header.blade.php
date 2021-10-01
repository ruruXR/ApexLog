@section('header')
<header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">
            @guest
                <a class="text-muted" href="{{ route('login') }}">ログイン</a>
                @if (Route::has('register'))
                    <a class="text-muted" href="{{ route('register') }}">新規登録</a>
                @endif
            @else
                <a class="text-muted" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
                >
                ログアウト
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endguest
      </div>
      <div class="col-4 text-center">
        <a class="blog-header-logo text-dark" href="/">ApexLog</a>
      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
          <a class="text-muted" href="/posts/create">投稿</a>
      </div>
    </div>
</header>
@endsection