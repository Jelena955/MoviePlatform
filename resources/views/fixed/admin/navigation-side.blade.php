<aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed;" >
    <!-- Brand Logo -->
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(auth ()->user ()->img!=null)
                <img src="{{asset ('assets/images').'/'.auth ()->user ()->img}}" class="img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{asset ('assets/images/nouserimg.png')}}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth ()->user ()->name}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->

        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/adminPanel" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v1</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Manage with
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/adminMovies" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Movies</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/adminTags" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tags</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/adminMenu" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Menu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/adminUser" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                        <a href="/adminGenre" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Genres</p>
                        </a>
                        </li>
                       <li class="nav-item">
                        <a href="/adminRole" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Roles</p>
                        </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
