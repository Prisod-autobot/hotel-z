@extends('layout.master')
@section('content')
    @include('sweetalert::alert')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Service</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">service</li>
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
                        <h6>Service Table</h6>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                            data-bs-target="#add_service">+Add</button>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatablesSimple" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>name</th>
                                    <th>description</th>
                                    <th>created_at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @php($i = '1')
                            <tbody>
                                @foreach ($service as $row)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->description }}</td>
                                        <td>{{ $row->created_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button class="btn btn-danger btn-sm btnId"
                                                    onclick="deleteImg({{ $row->id }})"><i
                                                        class="far fa-trash-alt"></i></button>
                                                <form id="delete-form-{{ $row->id }}"
                                                    action="{{ route('delete-service', $row->id) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                                <a class="btn btn-success btn-sm"
                                                    href="{{ route('edit-service', $row->id) }}"><i
                                                        class="far fa-edit"></i></a>
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
    <div class="modal fade" id="add_service" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="btn-close" id="close-btn" data-bs-dismiss="modal"></div>
                    <form action="{{ route('add-service') }}" method="post" class="form-control">
                        @csrf
                        <h2>RoomType</h2>
                        <div class="col d-grid">
                            <div class="form-group">
                                <label for="Name" class="h6">Service Name</label>
                                <input class="form-control m-2" type="name" name="name" placeholder="Name">
                            </div>
                        </div>
                        <div class="col d-grid">
                            <div class="form-group">
                                <label for="Name" class="h6">Description</label>
                                <textarea class="form-control" name="description" placeholder="Service"></textarea>
                            </div>
                        </div>
                        <div class="form-group d-grid m-2">
                            <button type="submit" class="btn btn-warning">Add Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Script DELETE --}}
@endsection
@section('script')
    <script>
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
