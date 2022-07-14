@extends('layout.master')
@section('content')
    @include('sweetalert::alert')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <p>User:</p>
                            </div>
                            <div class="row">
                                <h5 class="text-center">{{ $user }}</h5>
                            </div>
                            <div class="row">
                                <p class="text-end">account.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <p>Customer:</p>
                            </div>
                            <div class="row">
                                <h5 class="text-center">{{ $cus }}</h5>
                            </div>
                            <div class="row">
                                <p class="text-end">account.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <p>Income:</p>
                            </div>
                            <div class="row">
                                <h5 class="text-center">{{ number_format($book5) }} ฿</h5>
                            </div>
                            <div class="row">
                                <p class="text-end">only check in</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <p class="text-start">Booking:</p>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <span style="white-space:pre">Pending : {{ $book1 }}</span>
                                </div>
                                <div class="col">
                                    <span style="white-space:pre">Checked in : {{ $book2 }}</span>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="col">
                                    <span>
                                        Checked out : {{ $book3 }}
                                    </span>
                                </div>
                                <div class="col">
                                    <span>
                                        Cancelled : {{ $book4 }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="content-tip">
                <div class="col-3">
                    <div class="card" style="width: 15rem;height: 15rem;">
                        <div class="card-body">
                            <img style="width: 100%;height: 100%;" src="{{ URL::to('storeImage/add.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
