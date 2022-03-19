<nav class="navbar d-flex justify-content-between navbar-expand navbar-light bg-light">
    <a class="navbar-brand mx-3" href="/">{{ config('app.name') }}</a>
    <!-- Right Side Of Navbar -->
    <!-- Authentication Links -->
    <ul class="navbar-nav ms-auto mx-3">
        <div class="dropdown">
                <a href="#" class="nav-link dropdown-toggle" role="button" id="databaseLink" data-bs-toggle="dropdown" aria-expanded="false">
                    マイデータベース
                </a>
                <ul class="dropdown-menu" aria-labelledby="databaseLink">
                    <li><a href="{{route('wheel.index')}}" class="dropdown-item">ホイールのデータ一覧</a></li>
                    <li><a href="{{route('hub.index')}}" class="dropdown-item">ハブのデータ一覧</a></li>
                    <li><a href="{{route('rim.index')}}" class="dropdown-item">リムのデータ一覧</a></li>
                </ul>
        </div>
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                    </li>
                @endif

            @else
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
            @endguest
        </ul>
</nav>
