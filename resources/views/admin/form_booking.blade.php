<form action="#">
    @csrf
    <h2>Booking Details</h2>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="Name" class="h6">Room Number</label>
                <input disabled class="form-control m-2 border-0 fs-6" type="name" name="roomnum" id="roomnum">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="Name" class="h6">Customer Name</label>
                <input disabled class="form-control m-2 border-0 fs-6" type="name" name="cus_name" id="cus_name">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="Name" class="h6">Day Booking</label>
                <input disabled class="form-control m-2 border-0 fs-6" type="name" name="day" id="day">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="Name" class="h6">Cost Per Day</label>
                <input disabled class="form-control m-2 border-0 fs-6" type="name" name="cost" id="cost">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="Name" class="h6">Total</label>
                <input disabled class="form-control m-2 border-0 fs-6" type="name" name="result_cost" id="result_cost">
            </div>
        </div>
        <div class="col md-6">
            <div class="form-group">
                <label for="Name" class="h6">Create at</label>
                <input disabled class="form-control m-2 border-0 fs-6" type="name" name="create" id="create">
            </div>
        </div>
        <div class="col md-6">
            <div class="form-group">
                <label for="Name" class="h6">Payment</label>
                <input disabled class="form-control m-2 border-0 fs-6" type="name" name="pay" id="pay">
            </div>
        </div>
        <div class="col md-4">
            <div class="form-group">
                <label for="Name" class="h6">Status</label>
                <input disabled class="form-control m-2 border-0 fs-6" type="name" name="status" id="status">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col md-4">
            <label for="name" class="h6">Arrive Date</label>
            <input disabled class="form-control m-2 border-0 fs-6" type="name" name="arrive" id="arrive">
        </div>
        <div class="col md-4">
            <label for="name" class="h6">Arrive Date</label>
            <input disabled class="form-control m-2 border-0 fs-6" type="name" name="arr_diff" id="arr_diff">
        </div>
    </div>
    <div class="row">
        <div class="col md-4">
            <label for="name" class="h6">Departure Date</label>
            <input disabled class="form-control m-2 border-0 fs-6" type="name" name="depart" id="depart">
        </div>
        <div class="col md-4">
            <label for="name" class="h6">Departure Date</label>
            <input disabled class="form-control m-2 border-0 fs-6" type="name" name="de_diff" id="de_diff">
        </div>
    </div>
</form>
