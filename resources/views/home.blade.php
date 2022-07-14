@extends('layout.home')
@section('content')
    @include('sweetalert::alert')
    <section class="pt-1" id="ms">
        <div class="container">
            <div class="row">
                @if (Session::has('fail'))
                    <script>
                        $(document).ready(function() {
                            $('#detail-user').modal('show');
                        });
                    </script>
                @endif
                <div class="col">
                    <div class="card" style="width: 20rem;">
                        <div class=" card-header">
                            <h4>RESERVATION</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('reserve-room') }}" class="form-control" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <span>Check In</span>
                                        <div class="form-input">
                                            <span class="icon"><i class="far fa-calendar-alt"></i></span>
                                            <input readonly class="form-control" type="text" id="date-in-minifix"
                                                name="date_in" aria-describedby="inputGroup-sizing-sm">
                                        </div>
                                        <span class="text-danger from-control">
                                            @error('date_in')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <span>Check Out</span>
                                        <div class="form-input">
                                            <span class="icon"><i class="far fa-calendar-alt"></i></span>
                                            <input readonly class="form-control" type="text" id="date-out-minifix"
                                                name="date_out" aria-describedby="inputGroup-sizing-sm">
                                        </div>
                                        <span class="text-danger from-control">
                                            @error('date_out')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <span>Adult</span>
                                        <select class="form-select form-select-sm" name="max_adult" id="adult">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <span>Child</span>
                                        <select class="form-select form-select-sm" name="max_child" id="child">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        @if (Auth::check())
                                            @auth<div class="form-group d-grid m-3">
                                                    <button type="submit" class="btn btn-warning btn-sm">Check
                                                        Avalable
                                                        Room</button>
                                                </div>
                                            @endauth
                                        @else
                                            <div class="form-group d-grid m-3">
                                                <a type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#login">Check
                                                    Avalable Room</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <img style="width: 100%;height: 100%;" src="{{ URL::to('storeImage/hotel.webp') }}" alt="">
                </div>
            </div>
        </div>
    </section>
    <section class="pt-5" id="marketer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h5 class="text-secondary">Optimisation for</h5>
                    <p class="mb-2 fs-8 fw-bold">HOTel</p>
                    <p class="mb-4 fw-medium text-secondary">Few would argue that, despite the advancements of<br />feminism
                        over the past three decades, women still face a<br />double standard when it comes to their
                        behavior.</p>
                    <h4 class="fw-bold fs-1">Accessory makers</h4>
                    <p class="mb-4 fw-medium text-secondary">While most people enjoy casino gambling, sports
                        betting,<br />lottery and bingo playing for the fun</p>
                    <h4 class="fw-bold fs-1">Alterationists</h4>
                    <p class="mb-4 fw-medium text-secondary">If you are looking for a new way to promote your
                        business<br />that won't cost you money,</p>
                    <h4 class="fw-bold fs-1">Custom Design designers</h4>
                    <p class="mb-4 fw-medium text-secondary">If you are looking for a new way to promote your
                        business<br />that won't cost you more money,</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Button trigger modal -->

    <!-- Modal login -->
    <div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="btn-close" id="close-btn" data-bs-dismiss="modal"></div>
                    <form action="{{ route('login-user') }}" method="post" class="form-control">
                        @csrf
                        <h2>Login</h2>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" placeholder="Enter Email"
                                value="{{ old('email') }}" name="email">
                            <span class="text-danger from-control">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="password" class="h6">Password</label>
                            <input class="form-control" type="password" placeholder="Enter Password" name="password">
                            <span class="text-danger from-control">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="remember-me">
                            <label for="remember-me" class="h6">Remember me</label>
                        </div>
                        <div class="form-group d-grid">
                            <button class="btn btn-warning btn-block" type="submit">Login</button>
                        </div>
                    </form>
                    <div class="text-center forgotpass"><a href="forgot-password.html">Forgot Password?</a>
                    </div>
                    <div class="text-center dont-have">Don’t have an account? <a href="#" data-bs-dismiss="modal"
                            data-bs-target="#register" data-bs-toggle="modal">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- booking --}}
    <div class="modal fade" id="booking" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="btn-close" id="close-btn" data-bs-dismiss="modal"></div>
                    <h2 class="text-center">Booking</h2>
                    @foreach ($data as $row)
                        <div class="card m-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <h6>{{ $row->room_type_name }}</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6>{{ $row->room_cost . ' ฿' }}</h6>
                                    </div>
                                    <div class="col-3">
                                        <h6>{{ ucfirst($row->status) }}</h6>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <h6>Arrival: {{ $row->arrival_date }}</h6>
                                            <h6>Departure: {{ $row->departure_date }}</h6>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <a class="btn btn-danger btn-sm"
                                            href="{{ route('cancel-book', $row->id) }}">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Register -->
    <div class="modal fade" id="register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="btn-close" id="close-btn" data-bs-dismiss="modal"></div>
                    <form action="{{ route('register-user') }}" method="post" class="form-control">
                        @csrf
                        <h2>Register</h2>
                        <div class="form-group">
                            <label for="email">Name</label>
                            <input class="form-control" type="text" placeholder="Name" value="{{ old('name') }}"
                                name="name">
                            <span class="text-danger from-control">
                                @error('name')
                                    <script>
                                        $(document).ready(function() {
                                            $('#register').modal('show');
                                        });
                                    </script>
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" placeholder="Email" value="{{ old('email') }}"
                                name="email">
                            <span class="text-danger from-control">
                                @error('email')
                                    <script>
                                        $(document).ready(function() {
                                            $('#register').modal('show');
                                        });
                                    </script>
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="email">Password</label>
                            <input class="form-control" type="password" placeholder="Password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="email">Confirm Password</label>
                            <input class="form-control" type="password" placeholder="Confirm Password"
                                name="password_confirmation">
                            <span class="text-danger from-control">
                                @error('password')
                                    <script>
                                        $(document).ready(function() {
                                            $('#register').modal('show');
                                        });
                                    </script>
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group d-grid">
                            <label></label>
                            <button class="btn btn-warning btn-block" type="submit">Register</button>
                        </div>
                    </form>
                    <div class="text-center dont-have">Already have an account? <a href="#" data-bs-dismiss="modal"
                            data-bs-target="#login" data-bs-toggle="modal">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- booking --}}
    <div class="modal fade" id="booking" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="btn-close" id="close-btn" data-bs-dismiss="modal"></div>
                    <h2 class="text-center">Booking</h2>
                    @foreach ($data as $row)
                        <div class="card m-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <h6>{{ $row->room_type_name }}</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6>{{ $row->room_cost . ' ฿' }}</h6>
                                    </div>
                                    <div class="col-3">
                                        <h6>{{ ucfirst($row->status) }}</h6>
                                    </div>
                                    <div class="col-2">
                                        <a class="btn btn-danger btn-sm"
                                            href="{{ route('cancel-book', $row->id) }}">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    {{-- detail-user --}}
    <div class="modal fade" id="detail-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="btn-close" id="close-btn" data-bs-dismiss="modal"></div>
                    <form action="{{ route('update-data') }}" method="post" class="form-control">
                        @csrf
                        <h2>User Datails</h2>
                        <div class="form-group">
                            <label for="email">Telephone Number</label>
                            @php($id = Auth::id())
                            <input type="hidden" name="id" value="{{ $id }}">
                            <input class="form-control" type="text" placeholder="Tel" value="{{ old('tel') }}"
                                name="tel" maxlength="10">
                            <span class="text-danger from-control">
                                @error('tel')
                                    <script>
                                        $(document).ready(function() {
                                            $('#detail-user').modal('show');
                                        });
                                    </script>
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="email">Gender</label>
                            <select class="form-control" aria-label="Default select example" name="gender">
                                <option value="male">male</option>
                                <option value="female">female</option>
                                <option value="others">others</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">ID Card or Passport</label>
                            <input placeholder="ID Nunber" class="form-control" type="mail" name="id_card" maxlength="13"
                                id="id_card" value="{{ old('id_card') }}">
                            <span class="text-danger from-control">
                                @error('id_card')
                                    <script>
                                        $(document).ready(function() {
                                            $('#detail-user').modal('show');
                                        });
                                    </script>
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="email">Address</label>
                            <textarea name="address" id="address" cols="30" rows="4" class="form-control"></textarea>
                            <span class="text-danger from-control">
                                @error('address')
                                    <script>
                                        $(document).ready(function() {
                                            $('#detail-user').modal('show');
                                        });
                                    </script>
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group d-grid">
                            <label></label>
                            <button class="btn btn-warning btn-block" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
