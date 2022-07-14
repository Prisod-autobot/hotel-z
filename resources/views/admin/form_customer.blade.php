<form action="#" method="post" class="form-control">
    @csrf
    <h2>User Details</h2>
    <div class="row">
        <div class="col d-grid">
            <div class="form-group">
                <div class="col">
                    <label for="Name" class="h6">Booking ID</label>
                    <input disabled class="form-control m-2 border-0 fs-6" type="text" name="book" id="book">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col md-4">
            <div class="form-group">
                <label for="Name" class="h6">Name</label>
                <input disabled class="form-control m-2 fs-6" type="text" name="name" id="name">
            </div>
        </div>
        <div class="col md-4">
            <div class="form-group">
                <label for="Name" class="h6">Gender</label>
                <input disabled class="form-control m-2 fs-6" type="text" name="gen" id='gen'>
            </div>
        </div>
        <div class="col md-4">
            <div class="form-group">
                <label for="Name" class="h6">ID CARD</label>
                <input disabled class="form-control m-2 fs-6" type="text" name="cardid" id='cardid'>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col md-4">
            <div class="form-group">
                <label for="Name" class="h6">Address</label>
                <input disabled class="form-control m-2 fs-6" type="text" name="addx" id="addx">
            </div>
        </div>
        <div class="col md-4">
            <div class="form-group">
                <label for="Name" class="h6">Phone</label>
                <input disabled class="form-control m-2 fs-6" type="text" name="phone" id="phone">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col md-4">
            <div class="form-group">
                <label for="Name" class="h6">Status</label>
                <input disabled class="form-control m-2 fs-6" type="text" name="status" id="status">
            </div>
        </div>
        <div class="col md-4">
            <div class="form-group">
                <label for="Name" class="h6">Email</label>
                <input disabled class="form-control m-2 fs-6" type="text" name="mail" id="mail">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col md-4">
            <div class="form-group">
                <label for="Name" class="h6">ArrivalDate</label>
                <input disabled class="form-control m-2 fs-6" type="text" name="ardate" id="ardate">
            </div>
        </div>
        <div class="col md-4">
            <div class="form-group">
                <label for="Name" class="h6">DepartureDate</label>
                <input disabled class="form-control m-2 fs-6" type="text" name="dedate" id="dedate">
            </div>
        </div>
    </div>
</form>
