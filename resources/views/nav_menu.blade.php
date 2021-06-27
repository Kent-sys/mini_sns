@guest
<nav class="mobile-menu">
    <div class="mobile-menu__main">
        <li class="mobile-menu__item">
            <a class="mobile-menu__link app-title" href="/"><i class="fa fa-comments fa-icon mr-1"></i>mini_sns</a>
        </li>
        <li class="mobile-menu__item">
            <a class="mobile-menu__link" href="{{ route('register') }}">
                <span class="title">ユーザー登録</span>
            </a>
        </li>
        <li class="mobile-menu__item">
            <a class="mobile-menu__link" href="{{ route('login') }}">
                <span class="title">ログイン</span>
            </a>
        </li>
    </div>
</nav>
@endguest

@auth
<nav class="mobile-menu">
    <div class="mobile-menu__main">
        <li class="mobile-menu__item">
            <a class="mobile-menu__link app-title" href="/"><i class="fa fa-comments fa-icon mr-1"></i>mini_sns</a>
        </li>
        <li class="mobile-menu__item">
            <a class="mobile-menu__link" href="{{ route('articles.create') }}">
                <span class="title"><i class="fas fa-pen mr-1"></i>投稿する</span>
            </a>
        </li>
        <li class="mobile-menu__item">
            <a class="mobile-menu__link" href="{{ route('users.show', ['name' => Auth::user()->name]) }}">
                <span class="title">マイページ</span>
            </a>
        </li>
        <li class="mobile-menu__item">
            <form  id="logout_button" name="logout_button" method="POST" action="{{ route('logout') }}">
            @csrf
                <a class="mobile-menu__link" form="logout-button" href="javascript:logout_button.submit()">
                    <span class="title">ログアウト</span>
                </a>
            </form>
        </li>
    </div>
</nav>
@endauth
