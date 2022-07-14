<form action="#">
    @csrf
    <h2>Room Details</h2>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="Name" class="h6">Booking ID</label>
                <input disabled class="form-control m-2 border-0 fs-6" type="name" name="Booking" id="book">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="Name" class="h6">Room Number</label>
                <input disabled class="form-control m-2 border-0 fs-6" type="name" name="Number" id="num">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="Name" class="h6">Room Type</label>
                <input disabled class="form-control m-2 border-0 fs-6" type="name" name="Type" id="type">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col md-6">
            <div class="form-group">
                <label for="Name" class="h6">Avalable</label>
                <input disabled class="form-control m-2 border-0 fs-6" type="name" name="Avalable" id="availa">
            </div>
        </div>
        <div class="col md-4">
            <div class="form-group">
                <label for="Name" class="h6">Status</label>
                <input disabled class="form-control m-2 border-0 fs-6" type="name" name="Status" id="status">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col md-4">
            <label for="name" class="h6">Description</label>
            <textarea disabled class="form-control fs-6" rows="4" cols="50" name="description" id="des"></textarea>
        </div>
    </div>
</form>
