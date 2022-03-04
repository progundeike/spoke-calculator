<nav class="navbar d-flex justify-content-between navbar-expand navbar-light bg-light">
    <a class="navbar-brand mx-3" href="/">{{ config('app.name') }}</a>
    <!-- Right Side Of Navbar -->
    <ul class="navbar-nav ms-auto mx-3">
            <!-- Authentication Links -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('myDatabase.index') }}">マイデータベース</a>
            </li>
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
