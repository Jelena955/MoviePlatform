<nav class="navbar navbar-expand-lg navbar-dark bg-dark mt-0">
    <div class="container">
      <a class="navbar-brand" href="#"><h1 class="h3">Movie-platform</h1></a>
        @if(\Illuminate\Support\Facades\Route::currentRouteName ()=="allMovies")<form action="" method=""><input type="search" placeholder="Search" name="search" id="search"> </form>@endif
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>


      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          @foreach($menu as $link)
          <li class="nav-item @if(request()->routeIs($link["link"])) active @endif">
            <a class="nav-link" href="{{ $link["link"] }}">{{ $link["menu_title"] }}</a>
          </li>
          @endforeach
              @if(\Illuminate\Support\Facades\Auth::check ())
                  <li class="nav-item active">
                      <a class="nav-link" href="/profile">Profile</a>
                  </li>
                  <li class="nav-item active">
                      <a class="nav-link" href="/about">About</a>
                  </li>
            @if(auth ()->user ()->role_id==2)
                  <li class="nav-item active">
                      <a class="nav-link" href="/adminPanel">Admin panel</a>
                  </li>
              @endif
              @endif
        </ul>
      </div>
        @if(\Illuminate\Support\Facades\Auth::check ())
            {{--        @isset($user)--}}
            <div style="width: 100px">
                <button class="btn btn-outline-secondary" type="button" id="button-addon3"><a href="/logout">Logout</a></button></div>
            {{--            @endisset--}}
            <div style="width: 100px">
                @else <button class="btn btn-outline-secondary mr-3" type="button" id="button-addon3"><a href="/loginForm">Login</a></button>
                <button class="btn btn-outline-secondary" type="button" id="button-addon3"><a href="/registerForm">Register</a></button></div>
        @endif
    </div>
  </nav>
