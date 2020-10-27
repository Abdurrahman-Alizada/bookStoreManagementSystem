
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>BSM System | Home</title>


  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/css/app.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="text-secondary text-bold nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link text-secondary text-bold">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" v-model="search" @keyup="searchit"  type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" @click="searchit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->

     @can('isAdmin')
       <router-link to="/miniCart" class="btn btn-success btn-sm mr-3 ml-auto">  <i class="fas fa-shopping-cart mr-1 "></i>Cart</router-link>
     @endcan

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="/img/logo.png" alt=" Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">BSM System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/img/profile.png" class="img-circle elevation-2" alt="User">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth()->user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               @can('isAdmin')
               <li class="nav-item">
                <router-link to="/dashboard" class="nav-link">
                <i class="fas fa-tachometer-alt text-warning nav-icon"></i>
                  <p>DashBoard</p>
                </router-link>
              </li>

          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog text-success"></i>
              <p>
                Managment
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/users" class="nav-link">
                  <i class="fas fa-users  nav-icon text-success"></i>
                  <p>Users</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/books" class="nav-link">
                  <i class="fas fa-book text-warning nav-icon"></i>
                  <p>Books</p>
                </router-link>
              </li>

              <li class="nav-item">
                <router-link to="/categories" class="nav-link">
                  <i class="fas fa-book text-warning nav-icon"></i>
                  <p>Categories</p>
                </router-link>
              </li>

              <li class="nav-item">
                <router-link to="/salesAndPurchase" class="nav-link">
                <i class="fas fa-cart-arrow-down text-warning nav-icon"></i>
                  <p>Sales and Purchase</p>
                </router-link>
              </li>

              <li class="nav-item">
                <router-link to="/discount" class="nav-link">
                <i class="fas fa-tags text-warning nav-icon"></i>
                  <p>Discount</p>
                </router-link>
              </li>


            </ul>
          </li>
          @endcan

          <li class="nav-item">
                <router-link to="/profile" class="nav-link">
                <i class="fas fa-user-circle text-warning nav-icon"></i>
                  <p>Profile</p>
                </router-link>
              </li>
              <li class="nav-item">

              <router-link  to="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();" class="nav-link">
              <i class="fas fa-power-off text-danger nav-icon"></i>
                   <p> {{ __('Logout') }}</p>
              
                </router-link>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
              </li>

         </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        <router-view></router-view>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
  </footer>
</div>
<!-- ./wrapper -->

@auth
<script>
window.user = @json(auth()->user())
</script>
@endauth
<script src="/js/app.js"></script>
</body>
</html>
