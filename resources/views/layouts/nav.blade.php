<nav class="nav has-shadow" id="top">
  <div class="container">
    <div class="nav-left">
      <a class="nav-item" href="/">
        Buzzed
      </a>
    </div>
    <span class="nav-toggle">
      <span></span>
      <span></span>
      <span></span>
    </span>
    <div class="nav-right nav-menu">
      <a href="/" class="nav-item is-tab">
        Home
      </a>
      <a href="{{ route('entries.index') }}" class="nav-item is-tab">
        Diary
      </a>
      <a href="{{ route('products.index') }}" class="nav-item is-tab">
        Database
      </a>
      @if (Auth::guest())
          <span class="nav-item">
            <a class="button" href="{{ route('login') }}">
              Log in
            </a>
            <a class="button is-info" href="{{ route('register') }}">
              Sign up
            </a>
          </span>
      @else
          <span class="nav-item" href="{{ route('login') }}">
              <a class="button" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                  Logout
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
          </span>
      @endif
    </div>
  </div>
</nav>
