<nav class="navbar d-flex justify-content-between navbar-expand navbar-light bg-light">
    <!-- title -->
    <a class="navbar-brand mx-3" href="/">{{ config('app.name') }}</a>

    <!-- right side menu -->
    <ul class="nav navbar-nav">
        <a class="nav-link" href="#">パブリックデータベース</a>
        <div class="dropdown">
            @guest
                <a class="nav-link dropdown-toggle" id="dropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                    ユーザーメニュー
                </a>
            @else
                <a class="nav-link dropdown-toggle" id="dropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                    {{ Auth::user()->name }}
                </a>
            @endguest
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown">
                @guest
                    <li><a href="{{ route('register') }}" class="dropdown-item">ユーザー登録</a></li>
                    <li><a href="{{ route('login') }}" class="dropdown-item">ログイン</a></li>
                @else
                    <li><a href="{{route('wheel.index')}}" class="dropdown-item">マイホイールデータ</a></li>
                    <li><a href="{{route('hub.index')}}" class="dropdown-item">マイハブデータ</a></li>
                    <li><a href="{{route('rim.index')}}" class="dropdown-item">マイリムデータ</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"> ログアウト </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form>
                    </li>
                @endguest
                <li><a href="{{ route('inquiry') }}" class="dropdown-item">お問合せ</a></li>
            </ul>
        </div>
    </ul>

</nav>
