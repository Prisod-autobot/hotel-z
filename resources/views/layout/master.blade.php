<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Hotel</title>
    <link href="{{ URL::to('assets/css/modal.css') }}" rel="stylesheet" />
    <link href="{{ URL::to('assets/css/flatpickr.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::to('css/data_table_style.css') }}" rel="stylesheet" />
    <link href="{{ URL::to('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ URL::to('https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/cupertino/jquery-ui.css') }}"
        rel="stylesheet">
    <link href="{{ URL::to('assets/css/flatpickr.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::to('assets/css/material_green.css') }}" rel="stylesheet" />
    <script src="{{ URL::to('js/jquery-3.6.0.min.js') }}"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="{{ route('admin') }}">EmeralHotel</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    @if (Auth::check())
                        <li><a class="dropdown-item" href="#">@auth
                                    {{ Auth::user()->name }}
                                @endauth
                            </a></li>
                    @endif
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="{{ route('admin') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-pie"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="{{ route('index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-coffee"></i></div>
                            HomePage
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link" href="{{ route('booking') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-bed"></i></div>
                            Booking
                        </a>
                        <a class="nav-link" href="{{ route('customer') }}">
                            <div class="sb-nav-link-icon"><i class="far fa-user-circle"></i></div>
                            Customer
                        </a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-building"></i></div>
                            Room
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('room') }}">All Room</a>
                                <a class="nav-link" href="{{ route('roomtype') }}">Room Type</a>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="{{ route('image') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Images
                        </a>
                        <a class="nav-link" href="{{ route('service') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-glass-martini"></i></div>
                            Service
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    @if (Auth::check())
                        @auth
                            {{ Auth::user()->name }}
                        @endauth
                    @endif
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            @yield('content')
        </div>
    </div>
    <script src="{{ URL::to('assets/js/flatpickr.js') }}" crossorigin="anonymous"></script>
    <script src="{{ URL::to('js/all.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ URL::to('js/bootstrap.bundle.min.js') }}" crossorigin="anonymous">
    </script>
    <script src="{{ URL::to('js/Chart.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ URL::to('https://cdn.jsdelivr.net/npm/simple-datatables@latest') }}" crossorigin="anonymous">
    </script>
    <script src="{{ URL::to('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ URL::to('js/datatables-simple-demo.js') }}"></script>
    <script src="{{ URL::to('js/scripts.js') }}"></script>
    @yield('script')
</body>

</html>
