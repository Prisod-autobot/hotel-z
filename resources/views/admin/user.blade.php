@extends('layout.master')
@section('content')
    @include('sweetalert::alert')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">User & Customer</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Customer</li>
            </ol>
            {{-- NEW SECTION --}}
            @if (Session::has('successcus'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            @if (Session::has('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
            <div class="card mb-4">
                <div class="card-header d-md-flex ">
                    <div class="col align-self-start">
                        <h6>Customer Table</h6>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                            data-bs-target="#add_customer">+Add</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatablesSimplel" class="table table-striped" style="width:100%">
                            <thead>
                                <tr class="text-left">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Tell</th>
                                    <th>Email</th>
                                    <th>UID</th>
                                    <th>Created_at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($act = 'Normal')
                                @foreach ($cus as $row)
                                    <tr>
                                        <td>{{ $row->id }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->gender }}</td>
                                        <td>{{ $row->address }}</td>
                                        <td>{{ $row->phone }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->id_card }}</td>
                                        <td>{{ Carbon\Carbon::parse($row->created_at)->diffForHumans() }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button class="btn btn-danger btn-sm p-1 btnId"
                                                    onclick="deletecustomer({{ $row->id }})"><i
                                                        class="far fa-trash-alt"></i></button>
                                                <form id="delete-form-{{ $row->id }}"
                                                    action="{{ route('delete-cus', $row->id) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                                <a class="btn btn-warning btn-sm p-1"
                                                    href="{{ route('edit-customer', $row->id) }}"><i
                                                        class="far fa-edit"></i></a>
                                                <button class="btn btn-info btn-sm p-1" data-bs-toggle="modal"
                                                    data-book="{{ $row->book_id }}" data-name="{{ $row->name }}"
                                                    data-gen="{{ $row->gender }}" data-add="{{ $row->address }}"
                                                    data-phone="{{ $row->phone }}" data-status="{{ $act }}"
                                                    data-mail="{{ $row->email }}"
                                                    data-ardate="{{ $row->arrival_date }}"
                                                    data-dedate="{{ $row->departure_date }}"
                                                    data-cardid="{{ $row->id_card }}" data-bs-target="#customer"><i
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

        {{-- USER --}}
        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('successcus') }}</div>
        @endif
        @if (Session::has('fail'))
            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
        @endif
        <div class="card mb-4">
            <div class="card-header d-md-flex ">
                <h6>User Table</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatablesSimple" class="table table-striped" style="width:100%">
                        <thead>
                            <tr class="text-left">
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>level</th>
                                <th>Tell</th>
                                <th>Email</th>
                                <th>UID</th>
                                <th>Created_at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td><img class="rounded" src="{{ URL::to('storeImage/profile_test.jpg') }}"
                                            alt=""></td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->gender }}</td>
                                    <td>{{ $row->address }}</td>
                                    <td>{{ $row->level }}</td>
                                    <td>{{ $row->phone }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->id_card }}</td>
                                    <td>{{ Carbon\Carbon::parse($row->created_at)->diffForHumans() }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button class="btn btn-danger btn-sm p-1 btnId"
                                                onclick="deleteuser({{ $row->id }})"><i
                                                    class="far fa-trash-alt"></i></button>
                                            <form id="delete-form-{{ $row->id }}"
                                                action="{{ route('delete-user', $row->id) }}">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                            <a class="btn btn-warning btn-sm p-1"
                                                href="{{ route('edit-user', $row->id) }}"><i
                                                    class="far fa-edit"></i></a>
                                            <button class="btn btn-info btn-sm p-1" data-bs-toggle="modal"
                                                data-book="{{ $row->book_id }}" data-name="{{ $row->name }}"
                                                data-gen="{{ $row->gender }}" data-add="{{ $row->address }}"
                                                data-lev="{{ $row->level }}" data-phone="{{ $row->phone }}"
                                                data-status="{{ $act }}" data-mail="{{ $row->email }}"
                                                data-ardate="{{ $row->arrival_date }}"
                                                data-cardid="{{ $row->id_card }}"
                                                data-dedate="{{ $row->departure_date }}" data-bs-target="#user"><i
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
    </main>

    {{-- MODAL --}}
    <div class="modal fade" id="add_customer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="btn-close" id="close-btn" data-bs-dismiss="modal"></div>
                    <form action="{{ route('add-customer') }}" method="post" class="form-control">
                        @csrf
                        <h2>Add Customer</h2>
                        <div class="row">
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Name</label>
                                    <input placeholder="Enter name" class="form-control m-2 fs-6" type="name" name="name"
                                        id="name" value="{{ old('name') }}">
                                    <span class="text-danger from-control">
                                        @error('name')
                                            <script>
                                                $(document).ready(function() {
                                                    $('#add_customer').modal('show');
                                                });
                                            </script>
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Gender</label>
                                    <select class="form-select form-control m-2 fs-6" aria-label="Default select example"
                                        name="gen">
                                        <option value="male">male</option>
                                        <option value="female">female</option>
                                        <option value="others">others</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Address</label>
                                    <input placeholder="Enter Address" class="form-control m-2 fs-6" type="address"
                                        name="address" id="addx" value="{{ old('address') }}">
                                    <span class="text-danger from-control">
                                        @error('address')
                                            <script>
                                                $(document).ready(function() {
                                                    $('#add_customer').modal('show');
                                                });
                                            </script>
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Phone</label>
                                    <input placeholder="Phone Number" class="form-control m-2 fs-6" type="tel"
                                        maxlength="10" name="phone" id="phone" value="{{ old('phone') }}">
                                    <span class="text-danger from-control">
                                        @error('phone')
                                            <script>
                                                $(document).ready(function() {
                                                    $('#add_customer').modal('show');
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
                                    <label for="Name" class="h6">Email</label>
                                    <input placeholder="Email" class="form-control m-2 fs-6" type="mail" name="mail"
                                        id="mail" value="{{ old('mail') }}">
                                    <span class="text-danger from-control">
                                        @error('mail')
                                            <script>
                                                $(document).ready(function() {
                                                    $('#add_customer').modal('show');
                                                });
                                            </script>
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">ID Card or Passport</label>
                                    <input placeholder="ID Nunber" class="form-control m-2 fs-6" type="mail" name="id_card"
                                        maxlength="13" id="id_card" value="{{ old('id_card') }}">
                                    <span class="text-danger from-control">
                                        @error('id_card')
                                            <script>
                                                $(document).ready(function() {
                                                    $('#add_customer').modal('show');
                                                });
                                            </script>
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-grid m-3">
                            <button type="submit" class="btn btn-warning">Create Customer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL INFO --}}
    <div class="modal fade" id="user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="btn-close" id="close-btn" data-bs-dismiss="modal"></div>
                    @include('admin.form_user')
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL INFO --}}
    <div class="modal fade" id="customer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="btn-close" id="close-btn" data-bs-dismiss="modal"></div>
                    @include('admin.form_customer')
                </div>
            </div>
        </div>
    </div>
    {{-- Script DELETE --}}
@endsection
@section('script')
    <script>
        $('#user').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)

            var book = button.data('book')
            var name = button.data('name')
            var gen = button.data('gen')
            var addx = button.data('add')
            var lev = button.data('lev')
            var phone = button.data('phone')
            var status = button.data('status')
            var mail = button.data('mail')
            var ardate = button.data('ardate')
            var dedate = button.data('dedate')
            var cardid = button.data('cardid')

            var modal = $(this)

            modal.find('.modal-body #book').val(book);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #gen').val(gen);
            modal.find('.modal-body #addx').val(addx);
            modal.find('.modal-body #lev').val(lev);
            modal.find('.modal-body #phone').val(phone);
            modal.find('.modal-body #status').val(status);
            modal.find('.modal-body #mail').val(mail);
            modal.find('.modal-body #ardate').val(ardate);
            modal.find('.modal-body #dedate').val(dedate);
            modal.find('.modal-body #cardid').val(cardid);

        });

        $('#customer').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)

            var book = button.data('book')
            var name = button.data('name')
            var gen = button.data('gen')
            var addx = button.data('add')
            var phone = button.data('phone')
            var status = button.data('status')
            var mail = button.data('mail')
            var ardate = button.data('ardate')
            var dedate = button.data('dedate')
            var cardid = button.data('cardid')
            var modal = $(this)

            modal.find('.modal-body #book').val(book);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #gen').val(gen);
            modal.find('.modal-body #addx').val(addx);
            modal.find('.modal-body #phone').val(phone);
            modal.find('.modal-body #status').val(status);
            modal.find('.modal-body #mail').val(mail);
            modal.find('.modal-body #ardate').val(ardate);
            modal.find('.modal-body #dedate').val(dedate);
            modal.find('.modal-body #cardid').val(cardid);

        });

        function deleteuser(id) {
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

        function deletecustomer(id) {
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
