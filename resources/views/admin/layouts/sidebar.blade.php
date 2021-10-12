 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
     <a href="#" class="brand-link">
         <img src="/MyBlog1.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">MyBlog</span>
     </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/profile_pictures/{{Auth::user()->profilePicture}}" class="img-circle elevation-2" alt="{{Auth::user()->username}}">
            </div>
            <div class="info">
                <a href="{{route('admin.profile')}}" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>
      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
              <li class="nav-item">
                <a href="{{route('post.index')}}" class="nav-link">
{{--                  <i class="far fa-circle nav-icon"></i>--}}
                    <i class="fas fa-book-reader nav-icon"></i>
                  <p>Posts</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('category.index')}}" class="nav-link">
{{--                  <i class="far fa-circle nav-icon"></i>--}}
                    <i class="fa fa-list-alt nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('user.index')}}" class="nav-link">
{{--                  <i class="far fa-circle "></i>--}}
                    <i class="fas fa-users nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('comment.index')}}" class="nav-link">
{{--                  <i class="far fa-circle nav-icon"></i>/--}}
                    <i class="fas fa-comments nav-icon"></i>
                  <p>Comments</p>
                </a>
              </li>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
