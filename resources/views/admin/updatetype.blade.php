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
                    <form action="{{ route('update-roomtype', $data->id) }}" method="post" class="form-control">
                        @csrf
                        <h2>RoomType</h2>
                        <div class="row">
                            <div class="col d-grid">
                                <div class="form-group">
                                    <label for="Name" class="h6">Name</label>
                                    <input class="form-control m-2" type="name" name="name" placeholder="Name"
                                        value="{{ old('name') ?? $data->name }}">
                                    <span class="text-danger from-control">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Cost</label>
                                    <input class="form-control m-2" type="number" name="cost" placeholder="Cost"
                                        value="{{ old('cost') ?? $data->cost_per_day }}">
                                    <span class="text-danger from-control">
                                        @error('cost')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Discount %</label>
                                    <input class="form-control m-2" type="number" name="discount" placeholder="Discount"
                                        value="{{ old('discount') ?? $data->discount_percentage }}">
                                    <span class="text-danger from-control">
                                        @error('discount')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Size</label>
                                    <input class="form-control m-2" type="number" name="size" placeholder="Size"
                                        value="{{ old('size') ?? $data->size }}">
                                    <span class="text-danger from-control">
                                        @error('size')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Max Adult</label>
                                    <input class="form-control m-2" type="number" name="adult" placeholder="Adult" min="1"
                                        max="7" value="{{ old('adult') ?? $data->max_adult }}">
                                    <span class="text-danger from-control">
                                        @error('adult')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Max Child</label>
                                    <input class="form-control m-2" type="number" name="child" placeholder="Child" min="0"
                                        max="7" value="{{ old('child') ?? $data->max_child }}">
                                    <span class="text-danger from-control">
                                        @error('child')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Service</label>
                                    <select class="form-select form-control m-2 fs-6" aria-label="Default select example"
                                        name="service">
                                        @foreach ($service as $sv)
                                            <option value="{{ $sv->id }}">{{ $sv->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Image</label>
                                    <select class="form-select form-control m-2 fs-6" aria-label="Default select example"
                                        name="img">
                                        @foreach ($image as $img)
                                            <option value="{{ $img->id }}">{{ $img->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col md-4">
                                <label for="name" class="h6">Description</label>
                                <textarea class="form-control" rows="4" cols="50"
                                    name="description">{{ $data->description }}</textarea>
                                <span class="text-danger from-control">
                                    @error('description')
                                        {{ $message }}
                                    @enderror
                                </span>
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
