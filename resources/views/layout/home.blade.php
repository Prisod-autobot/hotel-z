<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HT</title>
    <meta name="theme-color" content="#ffffff">

    <!-- ===============================================-->
    <link href="{{ URL::to('https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css') }}"
        rel="stylesheet">
    <link href="{{ URL::to('assets/css/theme.css') }}" rel="stylesheet" />
    <link href="{{ URL::to('assets/css/modal.css') }}" rel="stylesheet" />
    <link href="{{ URL::to('assets/css/flatpickr.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::to('assets/css/material_green.css') }}" rel="stylesheet" />
    <script src="{{ URL::to('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ URL::to('js/jquery.min.js') }}"></script>

</head>


<body>
    <main class="main" id="top">
        <nav class="navbar navbar-expand-lg navbar-light sticky-top" data-navbar-on-scroll="data-navbar-on-scroll">
            <div class="container"><a class="navbar-brand" href="{{ route('index') }}"><img
                        src="{{ URL::to('assets/img/mine/emerralMine.png') }}" height="31" alt="logo"
                        style="color:#50c878;" />EmeralHotel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon">
                    </span></button>
                <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" aria-current="page"
                                href="{{ route('index') }}">หน้าแรก</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" aria-current="page"
                                href="{{ route('all-room-types') }}">ห้องพัก</a></li>
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="#superhero"></a>
                        </li>
                        <li class="nav-item"><a class="nav-link" aria-current="page"
                                href="{{ route('gallery') }}">แกลลอรี่</a></li>
                        @if (Auth::check() && Auth::user()->level == 'admin')
                            <li class="nav-item"><a class="nav-link" aria-current="page"
                                    href="{{ route('admin') }}">AdminDashboard</a></li>
                        @endif
                    </ul>
                    @if (!Auth::check())
                        <div class="d-flex ms-lg-4">
                            <button class="btn btn-secondary-outline" data-bs-toggle="modal"
                                data-bs-target="#login">Sign In</button>
                            <button class="btn btn-warning ms-3" data-bs-toggle="modal" data-bs-target="#register">Sign
                                Up</button>
                        </div>
                    @endif
                    @if (Auth::check())
                        @auth
                            <div class="btn-group">
                                <a href="#" aria-current="page" type="text" class="dropdown-toggle nav-link"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                            data-bs-target="#booking">Booking</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                                </ul>
                            </div>
                        @endauth
                    @endif
                </div>
            </div>
        </nav>
        @yield('content')
        <div class="footer-basic">
            <footer>
                <div class="social">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fas fa-map-marker-alt"></i></a>
                </div>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#">Home</a></li>
                    <li class="list-inline-item"><a href="#">Services</a></li>
                    <li class="list-inline-item"><a href="#">About</a></li>
                    <li class="list-inline-item"><a href="#">Terms</a></li>
                    <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                </ul>
                <p class="copyright">Company EmeralHotel © 2075</p>
            </footer>
        </div>
    </main>
    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="{{ URL::to('vendor/@popperjs/popper.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::to('vendor/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ URL::to('vendor/is/is.min.js') }}"></script>
    <script src="{{ URL::to('https://polyfill.io/v3/polyfill.min.js?features=window.scroll') }}"></script>
    <script src="{{ URL::to('vendor/fontawesome/all.min.js') }}"></script>
    <script src="{{ URL::to('https://code.jquery.com/ui/1.10.4/jquery-ui.js') }}"></script>
    <link href="{{ URL::to('css/css2.css') }}" rel="stylesheet">
    <script>
        $(function() {
            $('#date-in-minifix').datepicker({
                minDate: 0,
                changeMonth: true,
                dateFormat: 'yy-mm-dd',
                onSelect: function(dateText, inst) {
                    var start = $('#date-in-minifix').datepicker('getDate');
                    var end = $('#date-out-minifix').datepicker('getDate');
                    myMinDate = new Date(start.getTime());
                    myMinDate.setDate(myMinDate.getDate() + 1);
                    $('#date-out-minifix').datepicker('option', 'minDate', myMinDate);
                    if (start >= end) {
                        var toDate = new Date(inst.selectedYear, inst.selectedMonth, inst
                            .selectedDay);
                        var oneDay = new Date(toDate.getTime() + 86400000);
                        document.getElementById('date-out-minifix').value = $.datepicker.formatDate(
                            'yy-mm-dd', oneDay);
                    }
                    showDays();
                }
            });
            $('#date-out-minifix').datepicker({
                minDate: '2022-03-21',
                defaultDate: '+1d',
                maxdate: '+30D',
                changeMonth: true,
                dateFormat: 'yy-mm-dd',
                onSelect: showDays
            });

            function showDays() {
                var start = $('#date-in-minifix').datepicker('getDate');
                var end = $('#date-out-minifix').datepicker('getDate');
                if (!start || !end) return;
                var days = (end - start) / 1000 / 60 / 60 / 24;
                $('#num_nights_minifix').html(days);
            }
        });
    </script>
    @yield('script')
</body>

</html>
