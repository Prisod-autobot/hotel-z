@extends('layout.master')
@section('content')
    @include('sweetalert::alert')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">User Update</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">update-user</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body card-sm">
                    <form action="{{ route('update-user', $data_user->id) }}" method="post">
                        @csrf
                        <h2>User Details</h2>
                        <div class="row">
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Name</label>
                                    <input value="{{ old('name') ?? $data_user->name }}" class="form-control m-2 fs-6"
                                        type="text" name="name" id="name">
                                </div>
                            </div>
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Gender</label>
                                    <select class="form-select form-control m-2 fs-6" aria-label="Default select example"
                                        name="gen">
                                        <option value="male" {{ $data_user->gender == 'male' ? 'selected' : '' }}>male
                                        </option>
                                        <option value="female" {{ $data_user->gender == 'female' ? 'selected' : '' }}>
                                            female
                                        </option>
                                        <option value="others" {{ $data_user->gender == 'others' ? 'selected' : '' }}>
                                            others
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Address</label>
                                    <input value="{{ old('addx') ?? $data_user->address }}" class="form-control m-2 fs-6"
                                        type="text" name="addx" id="addx" placeholder="0/0">
                                </div>
                            </div>
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Level</label>
                                    <select class="form-select form-control m-2 fs-6" aria-label="Default select example"
                                        name="lev" id="lev">
                                        <option value="member" {{ $data_user->level == 'member' ? 'selected' : '' }}>
                                            member
                                        </option>
                                        <option value="admin" {{ $data_user->level == 'admin' ? 'selected' : '' }}>
                                            admin
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Phone</label>
                                    <input value="{{ old('phone') ?? $data_user->phone }}" class="form-control m-2 fs-6"
                                        type="tel" name="phone" id="phone" maxlength="10" placeholder="0123-456-7899">
                                </div>
                            </div>
                        </div>
                        <div class=" row">
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Email</label>
                                    <input disabled value="{{ old('mail') ?? $data_user->email }}"
                                        class="form-control m-2 fs-6" type="text" name="mail" id="mail">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">ArrivalDate</label>
                                    <input disabled value="{{ old('ardate') ?? $data_user->arrival_date }}"
                                        class="form-control m-2 fs-6" type="text" name="ardate" id="ardate">
                                </div>
                            </div>
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">DepartureDate</label>
                                    <input disabled value="{{ old('dedate') ?? $data_user->departure_date }}"
                                        class="form-control m-2 fs-6" type="text" name="dedate" id="dedate">
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-grid m-3">
                            <button type="submit" class="btn btn-warning">Update Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
