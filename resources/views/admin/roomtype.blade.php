@extends('layout.master')
@section('content')
    @include('sweetalert::alert')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Room Type</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">roomtype</li>
            </ol>

            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            @if (Session::has('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
            <div class="card mb-4">
                <div class="card-header d-md-flex ">
                    <div class="col align-self-start">
                        <h6>RoomType Table</h6>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                            data-bs-target="#add_room_type">+Add</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatablesSimple" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>imgage</th>
                                    <th>name</th>
                                    <th>today price</th>
                                    <th>size</th>
                                    <th>adult</th>
                                    <th>child</th>
                                    <th>description</th>
                                    <th>service</th>
                                    <th>created_at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @php($i = 1)
                            <tbody>
                                @foreach ($data as $row)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td><img class="rounded"
                                                src="{{ URL::to('storeImage/' . $row->caption) }}">
                                        </td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->cost_per_day }}</td>
                                        <td>{{ $row->size }}</td>
                                        <td>{{ $row->max_adult }}</td>
                                        <td>{{ $row->max_child }}</td>
                                        <td>{{ $row->description }}</td>
                                        <td>{{ $row->service_name }}</td>
                                        <td>{{ $row->created_at }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button class="btn btn-danger btn-sm p-1 btnId"
                                                    onclick="deleteImg({{ $row->id }})"><i
                                                        class="far fa-trash-alt"></i></button>
                                                <form id="delete-form-{{ $row->id }}"
                                                    action="{{ route('delete-type', $row->id) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                                <a class="btn btn-warning btn-sm p-1"
                                                    href="{{ route('edit-roomtype', $row->id) }}"><i
                                                        class="far fa-edit"></i></a>
                                                <button class="btn btn-info btn-sm p-1" data-bs-toggle="modal"
                                                    data-name="{{ $row->name }}" data-cost="{{ $row->cost_per_day }}"
                                                    data-discount="{{ $row->discount_percentage }}"
                                                    data-size="{{ $row->size }}" data-adult="{{ $row->max_adult }}"
                                                    data-child="{{ $row->max_child }}"
                                                    data-des="{{ $row->description }}"
                                                    data-service="{{ $row->service_name }}"
                                                    data-img="{{ $row->caption }}" data-bs-target="#info_room_type"><i
                                                        class="fas fa-info-circle"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- MODAL --}}
    <div class="modal fade" id="add_room_type" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="btn-close" id="close-btn" data-bs-dismiss="modal"></div>
                    <form action="{{ route('addroomtype') }}" method="post" class="form-control">
                        @csrf
                        <h2>RoomType Details</h2>
                        <div class="row">
                            <div class="col d-grid">
                                <div class="form-group">
                                    <label for="Name" class="h6">Name</label>
                                    <input class="form-control m-2" type="name" name="name" placeholder="Name">
                                    <span class="text-danger from-control">
                                        @error('name')
                                            <script>
                                                $(document).ready(function() {
                                                    $('#add_room_type').modal('show');
                                                });
                                            </script>
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
                                    <input class="form-control m-2" type="number" name="cost" placeholder="Cost">
                                    <span class="text-danger from-control">
                                        @error('cost')
                                            <script>
                                                $(document).ready(function() {
                                                    $('#add_room_type').modal('show');
                                                });
                                            </script>
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Discount %</label>
                                    <input class="form-control m-2" type="number" name="discount" placeholder="Discount">
                                    <span class="text-danger from-control">
                                        @error('discount')
                                            <script>
                                                $(document).ready(function() {
                                                    $('#add_room_type').modal('show');
                                                });
                                            </script>
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
                                    <input class="form-control m-2" type="number" name="size" placeholder="Size">
                                    <span class="text-danger from-control">
                                        @error('size')
                                            <script>
                                                $(document).ready(function() {
                                                    $('#add_room_type').modal('show');
                                                });
                                            </script>
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Max Adult</label>
                                    <input class="form-control m-2" type="number" name="adult" placeholder="Adult" min="1"
                                        max="7">
                                    <span class="text-danger from-control">
                                        @error('adult')
                                            <script>
                                                $(document).ready(function() {
                                                    $('#add_room_type').modal('show');
                                                });
                                            </script>
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Max Child</label>
                                    <input class="form-control m-2" type="number" name="child" placeholder="Child" min="0"
                                        max="7">
                                    <span class="text-danger from-control">
                                        @error('child')
                                            <script>
                                                $(document).ready(function() {
                                                    $('#add_room_type').modal('show');
                                                });
                                            </script>
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
                                <textarea class="form-control" rows="4" cols="50" name="description"></textarea>
                                <span class="text-danger from-control">
                                    @error('description')
                                        <script>
                                            $(document).ready(function() {
                                                $('#add_room_type').modal('show');
                                            });
                                        </script>
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group d-grid m-3">
                            <button type="submit" class="btn btn-warning">Add Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL INFO --}}
    <div class="modal fade" id="info_room_type" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="btn-close" id="close-btn" data-bs-dismiss="modal"></div>
                    @include('admin.form_modal')
                </div>
            </div>
        </div>
    </div>
    {{-- Script DELETE --}}
@endsection
@section('script')
    <script>
        $('#info_room_type').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)

            var title = button.data('name')
            var cost = button.data('cost')
            var discount = button.data('discount')
            var size = button.data('size')
            var adult = button.data('adult')
            var child = button.data('child')
            var service = button.data('service')
            var img = button.data('img')
            var description = button.data('des')
            var modal = $(this)

            modal.find('.modal-body #name').val(title);
            modal.find('.modal-body #cost').val(cost);
            modal.find('.modal-body #discount').val(discount);
            modal.find('.modal-body #size').val(size);
            modal.find('.modal-body #adult').val(adult);
            modal.find('.modal-body #child').val(child);
            modal.find('.modal-body #service').val(service);
            modal.find('.modal-body #img').val(img);
            modal.find('.modal-body #description').val(description);

        });

        function deleteImg(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endsection
