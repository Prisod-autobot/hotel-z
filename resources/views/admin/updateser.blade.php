@extends('layout.master')
@section('content')
    @include('sweetalert::alert')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Service Update</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">update-service</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body card-sm">
                    <form action="{{ route('update-service', $data_service->id) }}" method="post">
                        @csrf
                        <div class="col m-2">
                            <label for="name">Service Name</label>
                            <input class="form-control" type="text" name="name"
                                value="{{ old('name') ?? $data_service->name }}">
                        </div>
                        <div class="col m-2">
                            <label for="name">Description</label>
                            <textarea class="form-control" rows="12" cols="50"
                                name="description">{{ old('name') ?? $data_service->description }}</textarea>
                        </div>
                        <div class="d-grid m-2">
                            <button type="submit" class="btn btn-warning">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
