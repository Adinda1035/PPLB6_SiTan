<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>SI-Tan &rsaquo; @yield('title')</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset("bootstrap/node_modules/ionicons201/css/ionicons.min.css")}}">
    <link rel="stylesheet" href="{{asset("bootstrap/node_modules/bootstrap-daterangepicker/daterangepicker.css")}}">
    <link rel="stylesheet" href="{{asset("bootstrap/node_modules/select2/dist/css/select2.min.css")}}">
    <link rel="stylesheet" href="{{asset("bootstrap/node_modules/bootstrap-daterangepicker/daterangepicker.css")}}">
    <link rel="stylesheet" href="{{asset("bootstrap/node_modules/select2/dist/css/select2.min.css")}}">
    <link rel="stylesheet" href="{{asset("bootstrap/node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css")}}">
    <link rel="stylesheet" href="{{asset("bootstrap/node_modules/prismjs/themes/prism.css")}}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset("bootstrap/assets/css/style.css")}}">
    <link rel="stylesheet" href="{{asset("bootstrap/assets/css/components.css")}}">

</head>

<body>
<div id="app">
    <div class="main-wrapper">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                </ul>
            </form>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <div class="d-sm-none d-lg-inline-block">Hai, {{Auth::user()->username}}</div></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-title">MENU</div>
                        <a href="{{route("edit-profile")}}" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> Edit Profil
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="main-sidebar">
            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <a href="{{route("dashboard")}}">SI-Tan</a>
                </div>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="{{route("dashboard")}}">ST</a>
                </div>
                <ul class="sidebar-menu">
                    <li class="menu-header">Dashboard</li>
                    <li class="nav-item @yield('dashboard-active')"><a class="nav-link" href="{{route("dashboard")}}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>

                    @if(Auth::user()->hasRole('admin'))
                        <li class="menu-header">User</li>
                        <li class="nav-item dropdown @yield('user-active')">
                            <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Pengelolaan User</span></a>
                            <ul class="dropdown-menu">
                                <li class="@yield('index-user-active')"><a class="nav-link" href="{{route("admin-index-user")}}">Lihat User</a></li>
                                <li class="@yield('create-user-active')"><a class="nav-link" href="{{route("admin-create-user")}}">Buat User</a></li>
                            </ul>
                        </li>
                    @endif

                    @if(Auth::user()->hasRole('admin'))
                        <li class="menu-header">Kandang</li>
                        <li class="nav-item dropdown @yield('kandang-active')">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Pengelolaan Kandang</span></a>
                            <ul class="dropdown-menu">
                                <li class="@yield('index-kandang-active')"><a class="nav-link" href="{{route("admin-index-kandang")}}">Lihat Kandang</a></li>
                                <li class="@yield('create-kandang-active')"><a class="nav-link" href="{{route("admin-create-kandang")}}">Buat Kandang Baru</a></li>
                            </ul>
                        </li>
                    @endif

                    <li class="menu-header">Laporan</li>
                    <li class="nav-item dropdown @yield('laporan-harian-active')">
                        <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Laporan Harian</span></a>
                        <ul class="dropdown-menu">
                            @if(Auth::user()->hasRole('admin'))
                                <li class="@yield('index-laporan-harian-active')"><a class="nav-link" href="{{route("admin-index-laporan-harian")}}">Lihat Laporan Harian</a></li>
                            @endif
                            @if(Auth::user()->hasRole('karyawan'))
                                <li class="@yield('index-laporan-harian-active')"><a class="nav-link" href="{{route("index-laporan-harian")}}">Lihat Laporan Harian</a></li>
                                <li class="@yield('create-laporan-harian-active')"><a class="nav-link" href="{{route("create-laporan-harian")}}">Buat Laporan Harian</a></li>
                            @endif
                        </ul>
                    </li>

                    @if(Auth::user()->hasRole('admin'))
                        <li class="nav-item dropdown @yield('laporan-bulanan-active')">
                            <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Laporan Bulanan</span></a>
                            <ul class="dropdown-menu">
                                <li class="@yield('index-laporan-bulanan-active')"><a class="nav-link" href="{{route("admin-index-laporan-bulanan")}}">Lihat Laporan Bulanan</a></li>
                            </ul>
                        </li>
                    @endif

                    @if(Auth::user()->hasRole('karyawan'))
                        <li class="menu-header">Lain-lain</li>
                        <li class="nav-item @yield('simulasi-active')"><a class="nav-link" href="{{route("dashboard")}}"><i class="fas fa-fire"></i> <span>Simulasi Telur Asin</span></a></li>
                    @endif
                </ul>
            </aside>
        </div>

        <!-- Main Content -->
        @yield('content')

{{--        <footer class="main-footer">--}}
{{--            <div class="footer-left">--}}
{{--                Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>--}}
{{--            </div>--}}
{{--            <div class="footer-right">--}}
{{--                2.3.0--}}
{{--            </div>--}}
{{--        </footer>--}}
    </div>
</div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{asset("bootstrap/assets/js/stisla.js")}}"></script>

    <!-- JS Libraies -->
    <script src="{{asset("bootstrap/node_modules/cleave.js/dist/cleave.min.js")}}"></script>
    <script src="{{asset("bootstrap/node_modules/cleave.js/dist/addons/cleave-phone.id.js")}}"></script>
    <script src="{{asset("bootstrap/node_modules/bootstrap-daterangepicker/daterangepicker.js")}}"></script>
    <script src="{{asset("bootstrap/node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js")}}"></script>
    <script src="{{asset("bootstrap/node_modules/select2/dist/js/select2.full.min.js")}}"></script>
    <script src="{{asset("bootstrap/node_modules/prismjs/prism.js")}}"></script>

    <!-- Template JS File -->
    <script src="{{asset("bootstrap/assets/js/scripts.js")}}"></script>
    <script src="{{asset("bootstrap/assets/js/custom.js")}}"></script>

    <!-- Page Specific JS File -->
    <script src="{{asset("bootstrap/assets/js/page/bootstrap-modal.js")}}"></script>
    <script src="{{asset("bootstrap/assets/js/page/forms-advanced-forms.js")}}"></script>
    <script src="{{asset("bootstrap/assets/js/page/modules-ion-icons.js")}}"></script>
</body>
</html>
