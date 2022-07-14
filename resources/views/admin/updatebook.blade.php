@extends('layout.master')
@section('content')
    @include('sweetalert::alert')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Book Update</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">update-booking</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body card-sm">
                    <form action="{{ route('update-booking', $booking->id) }}" method="post">
                        @csrf
                        <h2>User Details</h2>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="Name" class="h6">Customer Name</label>
                                    <input type="text" disabled class="form-control" disabled
                                        value="{{ $customers->name }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col md-4">
                                    <div class="form-group">
                                        <label for="Name" class="h6">Arrival Date</label>
                                        <input readonly type="text" size="9" name="arrive" class="form-control"
                                            value="{{ old('arrive') ?? $booking->arrival_date }}">
                                    </div>
                                </div>
                                <div class="col md-4">
                                    <div class="form-group">
                                        <label for="Name" class="h6">Departure Date</label>
                                        <input readonly type="text" size="9" name="depart" class="form-control"
                                            value="{{ old('depart') ?? $booking->departure_date }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col md-4">
                                    <div class="form-group">
                                        <label for="Name" class="h6">Available Room</label>
                                        <input readonly type="text" size="9" name="room_num" class="form-control"
                                            value="{{ old('room_num') ?? $booking->room_id . ' | ' . $type->name }}">
                                    </div>
                                </div>
                                <div class="col md-4">
                                    <div class="form-group">
                                        <label for="Name" class="h6">Adult</label>
                                        <select class="col-sm-6 custom-select custom-select-sm form-control m-2 fs-6"
                                            name="max_adult">
                                            <option value="1" {{ $booking->childe == '1' ? 'selected' : '' }}>
                                                1
                                            </option>
                                            <option value="2" {{ $booking->childe == '2' ? 'selected' : '' }}>
                                                2
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col md-4">
                                    <div class="form-group">
                                        <label for="Name" class="h6">Child</label>
                                        <select class="col-sm-6 custom-select custom-select-sm form-control m-2 fs-6"
                                            name="max_child">
                                            <option value="1" {{ $booking->childe == '1' ? 'selected' : '' }}>
                                                1
                                            </option>
                                            <option value="2" {{ $booking->childe == '2' ? 'selected' : '' }}>
                                                2
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col md-4">
                                    <div class="form-group">
                                        <label for="Name" class="h6">Status</label>
                                        <select class="form-select form-control m-2 fs-6"
                                            aria-label="Default select example" name="status">
                                            <option value="pending"
                                                {{ $booking->status == 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="checked_in"
                                                {{ $booking->status == 'checked_in' ? 'selected' : '' }}>
                                                Checked in</option>
                                            <option value="checked_out"
                                                {{ $booking->status == 'checked_out' ? 'selected' : '' }}>
                                                Checked out</option>
                                            <option value="cancelled"
                                                {{ $booking->status == 'cancelled' ? 'selected' : '' }}>
                                                Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col md-4">
                                    <div class="form-group">
                                        <label for="Name" class="h6">Payment</label>
                                        <select class="form-select form-control m-2 fs-6"
                                            aria-label="Default select example" name="payment">
                                            <option value="1" {{ $booking->payment == '1' ? 'selected' : '' }}>
                                                Confirmed
                                            </option>
                                            <option value="2" {{ $booking->payment == '2' ? 'selected' : '' }}>
                                                Pending
                                            </option>
                                            <option value="3" {{ $booking->payment == '3' ? 'selected' : '' }}>
                                                Cancelled
                                            </option>
                                        </select>
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
