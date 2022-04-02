<nav class="navbar d-flex justify-content-between navbar-expand navbar-light bg-light">
    <a class="navbar-brand mx-3" href="/">{{ config('app.name') }}</a>
    <!-- Right Side Of Navbar -->
    <!-- Authentication Links -->
    <ul class="navbar-nav ms-auto mx-3">
        @guest
            <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('inquiry') }}">お問合せ</a>
                </li>
        @else
            <div class="dropdown">
                <a href="#" class="nav-link dropdown-toggle" role="button" id="databaseLink" data-bs-toggle="dropdown" aria-expanded="false">
                    マイデータベース
                </a>
                <ul class="dropdown-menu" aria-labelledby="databaseLink">
                    <li><a href="{{route('wheel.index')}}" class="dropdown-item">マイホイールデータ</a></li>
                    <li><a href="{{route('hub.index')}}" class="dropdown-item">マイハブデータ</a></li>
                    <li><a href="{{route('rim.index')}}" class="dropdown-item">マイリムデータ</a></li>
                </ul>
            </div>
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        ログアウト
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
            <li>
                <a class="nav-link" href="{{ route('inquiry') }}">お問合せ</a>
            </li>
        @endguest
    </ul>
</nav>
