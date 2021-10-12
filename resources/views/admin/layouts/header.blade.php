 <!-- Preloader -->
{{-- <div class="preloader flex-column justify-content-center align-items-center">--}}
{{--    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">--}}
{{--  </div>--}}

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" onclick="changeDisplay()" role="button"><i class="fas fa-bars" ></i></a>
        </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('home')}}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>
      <ul class="navbar-nav ml-auto">
          <li class="nav-item d-none d-sm-inline-block">
              @auth
                  <form id="logout-form" action="{{ route('logout') }}" method="POST">
                      @csrf
                      <input type="submit" style="border-style: none; background-color:white" class="nav-link" value="Log out">
                  </form>
              @endauth
          </li>
      </ul>
  </nav>
  <!-- /.navbar -->
