<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <img src="{{asset('/public/assets/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
            <span style="color:#ffffff">{!! session('admin')['role'] !!}</span>
            </div>
        </div>

      <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{asset('createNew')}}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Question 2</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{asset('salary')}}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Question 3</p>
                    </a>
                </li>
            </ul>
        </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>