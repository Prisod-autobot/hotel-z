@extends('layout.master')
@section('content')
    @include('sweetalert::alert')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Booking</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">booking</li>
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
                        <h6>Booking Table</h6>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                            data-bs-target="#add_booking">+Add</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatablesSimple" class="table table-striped table-sm" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Room Number</th>
                                    <th>Customer Name</th>
                                    <th>Cost Per Day</th>
                                    <th>Total(฿)</th>
                                    <th>Status</th>
                                    <th>Day</th>
                                    <th>Arrival</th>
                                    <th>Departure</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                    <?php
                                    $difarrive = Carbon\Carbon::parse($row->arrival_date)->diffForHumans();
                                    $difdepart = Carbon\Carbon::parse($row->departure_date)->diffForHumans();
                                    
                                    $arrive = $row->arrival_date;
                                    $depart = $row->departure_date;
                                    $fdate = strtotime($arrive);
                                    $tdate = strtotime($depart);
                                    $total = $tdate - $fdate;
                                    $day = floor($total / 86400);
                                    $result_cost = number_format($day * $row->cost);
                                    
                                    $create = Carbon\Carbon::parse($row->created_at)->diffForHumans();
                                    ?>
                                    <tr>
                                        <td>{{ $row->room_number }}</td>
                                        <td>{{ $row->cus_name }}</td>
                                        <td>{{ number_format($row->cost) }}</td>
                                        <td>{{ $row->room_cost }}</td>
                                        <td>{{ $row->status }}</td>
                                        <td>{{ $day }}</td>
                                        <td>{{ $row->arrival_date }}</td>
                                        <td>{{ $row->departure_date }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                {{-- <button class="btn btn-danger btn-sm p-1 btnId"
                                                    onclick="deletebooking({{ $row->id }})"><i
                                                        class="far fa-trash-alt"></i></button>
                                                <form id="delete-form-{{ $row->id }}"
                                                    action="{{ route('delete-booking', $row->id) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                </form> --}}
                                                <a class="btn btn-warning btn-sm p-1"
                                                    href="{{ route('edit-booking', $row->id) }}"><i
                                                        class="far fa-edit"></i></a>
                                                <button class="btn btn-info btn-sm p-1" data-bs-toggle="modal"
                                                    data-roomnum="{{ $row->room_number }}"
                                                    data-depart="{{ $row->departure_date }}"
                                                    data-cost="{{ $row->cost }}" data-cus_name="{{ $row->cus_name }}"
                                                    data-day="{{ $day }}" data-create="{{ $create }}"
                                                    data-result_cost="{{ $result_cost }}"
                                                    data-pay="{{ $row->payment }}" data-status="{{ $row->status }}"
                                                    data-arr_diff="{{ $difarrive }}" data-de_diff="{{ $difdepart }}"
                                                    data-arrive="{{ $row->arrival_date }}" data-bs-target="#booking"><i
                                                        class="fas fa-info-circle"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @foreach ($data_ex as $row)
                                    <?php
                                    $difarrive = Carbon\Carbon::parse($row->arrival_date)->diffForHumans();
                                    $difdepart = Carbon\Carbon::parse($row->departure_date)->diffForHumans();
                                    
                                    $arrive = $row->arrival_date;
                                    $depart = $row->departure_date;
                                    $fdate = strtotime($arrive);
                                    $tdate = strtotime($depart);
                                    $total = $tdate - $fdate;
                                    $day = floor($total / 86400);
                                    $result_cost = number_format($day * $row->cost);
                                    
                                    $create = Carbon\Carbon::parse($row->created_at)->diffForHumans();
                                    ?>
                                    <tr>
                                        <td>{{ $row->room_number }}</td>
                                        <td>{{ $row->use_name }}</td>
                                        <td>{{ number_format($row->cost) }}</td>
                                        <td>{{ $result_cost }}</td>
                                        <td>{{ $row->status }}</td>
                                        <td>{{ $day }}</td>
                                        <td>{{ $row->arrival_date }}</td>
                                        <td>{{ $row->departure_date }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                {{-- <button class="btn btn-danger btn-sm p-1 btnId"
                                                    onclick="deletebooking({{ $row->id }})"><i
                                                        class="far fa-trash-alt"></i></button>
                                                <form id="delete-form-{{ $row->id }}"
                                                    action="{{ route('delete-booking', $row->id) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                </form> --}}
                                                <a class="btn btn-warning btn-sm p-1"
                                                    href="{{ route('edits-booking', $row->id) }}"><i
                                                        class="far fa-edit"></i></a>
                                                <button class="btn btn-info btn-sm p-1" data-bs-toggle="modal"
                                                    data-roomnum="{{ $row->room_number }}"
                                                    data-depart="{{ $row->departure_date }}"
                                                    data-cost="{{ $row->cost }}" data-cus_name="{{ $row->use_name }}"
                                                    data-day="{{ $day }}" data-create="{{ $create }}"
                                                    data-result_cost="{{ $result_cost }}"
                                                    data-pay="{{ $row->payment }}" data-status="{{ $row->status }}"
                                                    data-arr_diff="{{ $difarrive }}" data-de_diff="{{ $difdepart }}"
                                                    data-arrive="{{ $row->arrival_date }}" data-bs-target="#booking"><i
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

    <div class="modal fade" id="add_booking" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="btn-close" id="close-btn" data-bs-dismiss="modal"></div>
                    <form action="{{ route('add-booking') }}" method="post" class="form-control">
                        @csrf
                        <h2>Booking</h2>
                        <div class="row">
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Customer Name</label>
                                    <select class="form-select form-control m-2 fs-6" aria-label="Default select example"
                                        name="book_cus">
                                        <option value="">------Empty------</option>
                                        @foreach ($customers as $books)
                                            <option value="{{ $books->id }}">
                                                {{ $books->id . ' | ' . $books->name . ' | ' . $books->phone }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Arrival Date</label>
                                    <input readonly type="datetime-local" id="date_picker1" size="9" name="arrive"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Departure Date</label>
                                    <input readonly type="datetime-local" id="date_picker2" size="9" name="depart"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{-- <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Room Type</label>
                                    <select class="form-select form-control m-2 fs-6 dynamic"
                                        aria-label="Default select example" name="room_type" id="room_type">
                                        <option value="">Room Type</option>
                                        @foreach ($type as $row)
                                            <option value="{{ $row->id }}">
                                                {{ ucfirst($row->name) . ' | ' . $row->cost_per_day . ' ฿' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Available Room</label>
                                    <select class="form-select form-control m-2 fs-6 dynamic"
                                        aria-label="Default select example" name="room_num" id="room_num">
                                        <option value="">Available Room</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Adult</label>
                                    <input list="adult" name="max_adult"
                                        class="col-sm-6 custom-select custom-select-sm form-control m-2 fs-6">
                                    <datalist id="adult">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </datalist>
                                </div>
                            </div>
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Child</label>
                                    <input list="child" name="max_child"
                                        class="col-sm-6 custom-select custom-select-sm form-control m-2 fs-6">
                                    <datalist id="child">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </datalist>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Status</label>
                                    <select class="form-select form-control m-2 fs-6" aria-label="Default select example"
                                        name="status">
                                        <option value="pending">Pending</option>
                                        <option value="checked_in">Checked in</option>
                                        <option value="checked_out">Checked out</option>
                                        <option value="checked_out">Cancelled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="Name" class="h6">Payment</label>
                                    <select class="form-select form-control m-2 fs-6" aria-label="Default select example"
                                        name="payment">
                                        <option value="1">Confirmed</option>
                                        <option value="2">Cancelled</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-grid m-3">
                            <button type="submit" class="btn btn-warning">Create Booking</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL INFO --}}
    <div class="modal fade" id="booking" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="btn-close" id="close-btn" data-bs-dismiss="modal"></div>
                    @include('admin.form_booking')
                </div>
            </div>
        </div>
    </div>
    {{-- Script DELETE --}}
@endsection
@section('script')
    <script>
        config = {
            minDate: "today",
            maxDate: new Date().fp_incr(30)
        }
        flatpickr("input[type=datetime-local]", config);

        $('#booking').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)

            var roomnum = button.data('roomnum')
            var cus_name = button.data('cus_name')
            var result_cost = button.data('result_cost')
            var pay = button.data('pay')
            var status = button.data('status')
            var arrive = button.data('arrive')
            var depart = button.data('depart')
            var arr_diff = button.data('arr_diff')
            var de_diff = button.data('de_diff')
            var create = button.data('create')
            var day = button.data('day')
            var cost = button.data('cost')
            var modal = $(this)

            modal.find('.modal-body #roomnum').val(roomnum);
            modal.find('.modal-body #cus_name').val(cus_name);
            modal.find('.modal-body #result_cost').val(result_cost);
            modal.find('.modal-body #pay').val(pay);
            modal.find('.modal-body #status').val(status);
            modal.find('.modal-body #arrive').val(arrive);
            modal.find('.modal-body #depart').val(depart);
            modal.find('.modal-body #arr_diff').val(arr_diff);
            modal.find('.modal-body #de_diff').val(de_diff);
            modal.find('.modal-body #create').val(create);
            modal.find('.modal-body #day').val(day);
            modal.find('.modal-body #cost').val(cost);

        });

        function deletebooking(id) {
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

        $(document).ready(function() {
            $('#date_picker1').on('change', function() {
                var id_date = $(this).val();
                $.ajax({
                    url: '/getNumber/' + id_date,
                    type: 'get',
                    dataType: 'json',
                    beforeSend: function() {
                        $("#room_num").html('<option>LOADIN...</option>');
                    },
                    success: function(res) {
                        if (res) {
                            $('#room_num').empty();
                            $.each(res, function(key, room_num) {
                                $('select[name="room_num"]').append(
                                    '<option value="' + room_num.id + '">' +
                                    room_num.room_number + ' | ' + room_num.name +
                                    ' | ' + room_num.cost_per_day + ' ฿' +
                                    '</option>'
                                )
                            });
                        } else {
                            $('#room_num').empty();
                        }
                    }
                })
            })
        });
    </script>
@endsection
