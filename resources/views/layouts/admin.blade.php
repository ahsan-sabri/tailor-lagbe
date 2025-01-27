<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>{{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- favicon --}}
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="/css/app.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper" id="app">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">

            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>

            </ul>

            <!-- SEARCH FORM -->
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" @keyup="searchit" v-model="search" type="search"
                    placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" @click="searchit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="brand-link">
                <img src="{{ asset('img/logo.png') }}" alt="AdminLTE Logo" class="brand-image elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="./img/profile.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="{{ route('admin') }}" class="d-block">
                            {{ ucfirst(trans(Auth::user()->name)) }}
                            <p>{{ ucfirst(trans(Auth::user()->user_type)) }}</p>
                        </a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <router-link to="/dashboard" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt blue"></i>
                                <p>
                                    Dashboard

                                </p>
                            </router-link>
                        </li>

                        @can('isAdmin')
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-cog green"></i>
                                    <p>
                                        Management
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <router-link to="/users" class="nav-link">
                                            <i class="fas fa-users nav-icon"></i>
                                            <p>Users</p>
                                        </router-link>
                                    </li>

                                </ul>
                            </li>

                            <li class="nav-item">
                                <router-link to="/developer" class="nav-link">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>
                                        Developer
                                    </p>
                                </router-link>
                            </li>
                        @endcan
                        <li class="nav-item">
                            <router-link to="/profile" class="nav-link">
                                <i class="nav-icon fas fa-user orange"></i>
                                <p>
                                    Profile
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                                <i class="nav-icon fa fa-power-off red"></i>
                                <p>
                                    {{ __('Logout') }}
                                </p>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
            <!-- Main content -->
            <main class="py-4">
                @yield('content')
            </main>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- Default to the center -->
            <div class="text-center">
                <strong>Copyright &copy; 2020-2022 <a href="javascript:;">Ahsan Sabri</a>.</strong> All rights reserved.
            </div>

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
