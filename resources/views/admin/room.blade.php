@extends('layout.master')
@section('content')
    @include('sweetalert::alert')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Room</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">room</li>
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
                        <h6>Room Table</h6>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                            data-bs-target="#add_room">+Add</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatablesSimple" class="table table-striped table-sm" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Room Number</th>
                                    <th>Description</th>
                                    <th>Available</th>
                                    <th>Status</th>
                                    <th>Room Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @php($i = 1)
                            <tbody>
                                @foreach ($data as $row)
                                    @if ($row->status == 1)
                                        @php($st = 'Enable')
                                    @else
                                        @php($st = 'Disable')
                                    @endif
                                    @if ($row->available == 1)
                                        @php($av = 'Available')
                                    @else
                                        @php($av = 'Reserve')
                                    @endif
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $row->room_number }}</td>
                                        <td>{{ $row->description }}</td>
                                        <td>{{ $av }}</td>
                                        <td>{{ $st }}</td>
                                        <td>{{ $row->room_types }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button class="btn btn-danger btn-sm p-1 btnId"
                                                    onclick="deleteroom({{ $row->id }})"><i
                                                        class="far fa-trash-alt"></i></button>
                                                <form id="delete-form-{{ $row->id }}"
                                                    action="{{ route('delete-room', $row->id) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                                <a class="btn btn-warning btn-sm p-1"
                                                    href="{{ route('edit-room', $row->id) }}"><i
                                                        class="far fa-edit"></i></a>
                                                <button class="btn btn-info btn-sm p-1" data-bs-toggle="modal"
                                                    data-book="{{ $row->booking_id }}"
                                                    data-num="{{ $row->room_number }}"
                                                    data-des="{{ $row->description }}" data-availa="{{ $av }}"
                                                    data-type="{{ $row->room_types }}" data-status="{{ $st }}"
                                                    data-bs-target="#room"><i class="fas fa-info-circle"></i></button>
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
    <div class="modal fade" id="add_room" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="btn-close" id="close-btn" data-bs-dismiss="modal"></div>
                    <form action="{{ route('add-room') }}" method="post" class="form-control">
                        @csrf
                        <h2>Room Details</h2>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="Name" class="h6">Room Number</label>
                                    <input class="form-control m-2" type="name" name="room_number" placeholder="RoomNumber">
                                    <span class="text-danger from-control">
                                        @error('room_number')
                                            <script>
                                                $(document).ready(function() {
                                                    $('#add_room').modal('show');
                                                });
                                            </script>
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="Name" class="h6">Status</label>
                                    <select class="form-select form-control m-2 fs-6" aria-label="Default select example"
                                        name="status">
                                        <option value="1" selected>Enable</option>
                                        <option value="2">Disable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="Name" class="h6">Available</label>
                                    <select class="form-select form-control m-2 fs-6" aria-label="Default select example"
                                        name="available">
                                        <option value="1" selected>Available</option>
                                        <option value="2">Reserve</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col md-6">
                                <div class="form-group">
                                    @php($i = null)
                                    <label for="Name" class="h6">Booking</label>
                                    <select class="form-select form-control m-2 fs-6" aria-label="Default select example"
                                        name="book">
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
                            <div class="col md-2">
                                <div class="form-group">
                                    <label for="Name" class="h6">How many Room</label>
                                    <select class="form-select form-control m-2 fs-6" aria-label="Default select example"
                                        name="many_room">
                                        <option value="1" selected>1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
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
                                                $('#add_room').modal('show');
                                            });
                                        </script>
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group d-grid m-3">
                            <button type="submit" class="btn btn-warning">Add Room</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL INFO --}}
    <div class="modal fade" id="room" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="btn-close" id="close-btn" data-bs-dismiss="modal"></div>
                    @include('admin.form_room')
                </div>
            </div>
        </div>
    </div>
    {{-- Script DELETE --}}
@endsection
@section('script')
    <script>
        $('#room').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)

            var book = button.data('book')
            var num = button.data('num')
            var type = button.data('type')
            var availa = button.data('availa')
            var status = button.data('status')
            var des = button.data('des')
            var modal = $(this)

            modal.find('.modal-body #book').val(book);
            modal.find('.modal-body #num').val(num);
            modal.find('.modal-body #type').val(type);
            modal.find('.modal-body #availa').val(availa);
            modal.find('.modal-body #status').val(status);
            modal.find('.modal-body #des').val(des);

        });

        function deleteroom(id) {
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
