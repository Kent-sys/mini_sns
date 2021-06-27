<nav class="navbar navbar-expand navbar-dark mean-fruit-gradient">

  <a class="navbar-brand" href="/"><i class="fa fa-comments mr-1"></i>mini_sns</a>

  <ul class="navbar-nav ml-auto">
    <!-- 検索フォーム -->
    <!-- <li class="nav-item">
       <form class="form-inline mr-4" action="" method="get">
        <div class="input-group input-group-sm ">
          <input type="text" name="keyword" class="form-control input-sm shadow-none" placeholder="キーワード検索">
          <div class="input-group-append">
            <button type="submit" class="btn btn-light p-0 pr-2 pl-2 m-0 shadow-none">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
       </form>
    </li> -->
    <!-- ハンバーガーメニュー -->
    <button class="mobile-menu__btn d-block d-md-none">
      <span></span>
      <span></span>
      <span></span>
    </button>

    @guest
    <li class="nav-item d-none d-md-block">
      <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
    </li>
    @endguest

    @guest
    <li class="nav-item d-none d-md-block">
      <a class="nav-link" href="{{ route('login') }}">ログイン</a>
    </li>
    @endguest

    @auth
    <li class="nav-item d-none d-md-block">
      <a class="nav-link" href="{{ route('articles.create') }}"><i class="fas fa-pen mr-1"></i>投稿する</a>
    </li>
    @endauth

    <!-- Dropdown -->
    @auth
    <li class="nav-item dropdown d-none d-md-block">
      <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
         aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-circle"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
        <button class="dropdown-item" type="button"
                onclick="location.href='{{ route('users.show', ['name' => Auth::user()->name]) }}'">
          マイページ
        </button>
        <div class="dropdown-divider"></div>
        <button form="logout-button" class="dropdown-item" type="submit">
          ログアウト
        </button>
      </div>
    </li>
    <form id="logout-button" method="POST" action="{{ route('logout') }}">
      @csrf
    </form>
    @endauth
    <!-- Dropdown -->

  </ul>

</nav>
