@extends('layout.master')
@section('content')
    @include('sweetalert::alert')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Room Update</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">update-room</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body card-sm">
                    <form action="{{ route('update-room', $data_room->id) }}" method="post">
                        @csrf
                        <h2>Room Details</h2>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="Name" class="h6">Room Number</label>
                                    <input class="form-control m-2" type="name" name="room_number"
                                        value="{{ old('room_number') ?? $data_room->room_number }}">
                                    <span class="text-danger from-control">
                                        @error('room_number')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="Name" class="h6">Status</label>
                                    <select class="form-select" aria-label="Default select example" name="status">
                                        <option value="1" selected>Enable</option>
                                        <option value="2">Disable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="Name" class="h6">Available</label>
                                    <select class="form-select" aria-label="Default select example" name="available">
                                        <option value="1" selected>Available</option>
                                        <option value="2">Reserve</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col md-6">
                                <div class="form-group">
                                    <label for="Name" class="h6">Booking</label>
                                    @php($i = null)
                                    <select class="form-select form-control m-2 fs-6" aria-label="Default select example"
                                        name="booking">
                                        <option value="{{ $i }}">------Empty------</option>
                                        @foreach ($book as $books)
                                            <option value="{{ $books->id }}">{{ $books->id }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">RoomType</label>
                                    <select class="form-select form-control m-2 fs-6" aria-label="Default select example"
                                        name="type">
                                        @foreach ($type as $types)
                                            <option value="{{ $types->id }}">{{ $types->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col md-4">
                                <label for="name" class="h6">Description</label>
                                <textarea class="form-control" rows="4" cols="50"
                                    name="description">{{ old('description') ?? $data_room->description }}</textarea>
                                <span class="text-danger from-control">
                                    @error('description')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group d-grid m-3">
                            <button type="submit" class="btn btn-warning">Update Room</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
