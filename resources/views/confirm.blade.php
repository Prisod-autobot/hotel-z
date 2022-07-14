@extends('layout.home')
@section('content')
    @include('sweetalert::alert')
    <section class="pt-9" id="ms">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body ">
                            <form action="" method="post" class="form-control">
                                <h3 class="text-center">Booking Information</h3>
                                @csrf
                                <?php
                                $fdate = strtotime($date_in);
                                $tdate = strtotime($date_out);
                                $total = $tdate - $fdate;
                                $day = floor($total / 86400);
                                $result_cost = number_format($day * $room_type->cost_per_day);
                                ?>
                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                            <label for="name" class="col-sm-2 col-form-label">Night</label>
                                            <div class="col-sm-10">
                                                <input id="name" readonly class="form-control-plaintext" type="text"
                                                    value="{{ $day . ' night' }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="name" class="col-sm-2 col-form-label">Cost</label>
                                            <div class="col-sm-10">
                                                <input id="name" readonly class="form-control-plaintext" type="text"
                                                    value="{{ $result_cost . ' ฿' }} ">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="name" class="col-sm-2 col-form-label">Arrive Date</label>
                                            <div class="col-sm-10">
                                                <input id="name" readonly class="form-control-plaintext" type="text"
                                                    value="{{ $date_in }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="name" class="col-sm-2 col-form-label">Depart Date</label>
                                            <div class="col-sm-10">
                                                <input id="name" readonly class="form-control-plaintext" type="text"
                                                    value="{{ $date_out }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="name" class="col-sm-2 col-form-label">Adult, Child</label>
                                            <div class="col-sm-10">
                                                <input id="name" readonly class="form-control-plaintext" type="text"
                                                    value="{{ $adult . ', ' . $chile }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="name" class="col-sm-2 col-form-label">Room Type</label>
                                            <div class="col-sm-10">
                                                <input id="name" readonly class="form-control-plaintext" type="text"
                                                    value="{{ $room_type->name }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('user-book') }}" method="post" class="form-control">
                                @csrf
                                <?php
                                $fdate = strtotime($date_in);
                                $tdate = strtotime($date_out);
                                $total = $tdate - $fdate;
                                $day = floor($total / 86400);
                                $result = $day * $room_type->cost_per_day;
                                $result_cost = number_format($day * $room_type->cost_per_day);
                                ?>
                                <h4>Profile</h4>
                                <div class="row">
                                    <input type="hidden" name="cost" value="{{ $result }}">
                                    <input type="hidden" name="date_in" value="{{ $date_in }}">
                                    <input type="hidden" name="date_out" value="{{ $date_out }}">
                                    <input type="hidden" name="adult" value="{{ $adult }}">
                                    <input type="hidden" name="chile" value="{{ $chile }}">
                                    <input type="hidden" name="room_num" value="{{ $data->room_number }}">
                                    <input type="hidden" name="type" value="{{ $data->room_type_id }}">
                                    <label for="name" class="col-4 col-form-label">Name</label>
                                    <div class="col-8">
                                        <input id="name" readonly class="form-control-plaintext" type="text"
                                            value="{{ $name }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="name" class="col-4 col-form-label">E-mail</label>
                                    <div class="col-8">
                                        <input id="name" readonly class="form-control-plaintext" type="text"
                                            value="{{ $mail }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="name" class="col-4 col-form-label">Tel.</label>
                                    <div class="col-8">
                                        <input id="name" readonly class="form-control-plaintext" type="text"
                                            value="{{ $phone }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="name" class="col-4 col-form-label">ID.</label>
                                    <div class="col-8">
                                        <input id="name" readonly class="form-control-plaintext" type="text"
                                            value="{{ $id_num }}">
                                    </div>
                                </div>
                                <div class="border-button"></div>
                                <div class="row">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Accept the terms and confirm the accuracy of the information.
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group d-grid">
                                    <button type="submit" class="btn btn-warning btn-sm" id="btncheck">Create
                                        Booking</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $('#flexCheckDefault').change(function() {
            $('#btncheck').prop("disabled", !this.checked);
        }).change()
    </script>
@endsection
