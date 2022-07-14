<form action="#" method="post" class="form-control">
    @csrf
    <h2>Details</h2>
    <div class="row">
        <div class="col d-grid">
            <div class="form-group">
                <div class="col">
                    <label for="Name" class="h6">Name</label>
                    <input disabled class="form-control m-2 border-0 fs-6" type="text" name="name" id="name">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col md-4">
            <div class="form-group">
                <label for="Name" class="h6">Cost</label>
                <input disabled class="form-control m-2 fs-6" type="text" name="cost" id="cost">
            </div>
        </div>
        <div class="col md-4">
            <div class="form-group">
                <label for="Name" class="h6">Discount %</label>
                <input disabled class="form-control m-2 fs-6" type="text" name="discount" id='discount'>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col md-4">
            <div class="form-group">
                <label for="Name" class="h6">Size</label>
                <input disabled class="form-control m-2 fs-6" type="text" name="size" id="size">
            </div>
        </div>
        <div class="col md-4">
            <div class="form-group">
                <label for="Name" class="h6">Max Adult</label>
                <input disabled class="form-control m-2 fs-6" type="text" name="adult" id="adult">
            </div>
        </div>
        <div class="col md-4">
            <div class="form-group">
                <label for="Name" class="h6">Max Child</label>
                <input disabled class="form-control m-2 fs-6" type="text" name="child" id="child">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col md-4">
            <div class="form-group">
                <label for="Name" class="h6">Service</label>
                <input disabled class="form-control m-2 fs-6" type="text" name="service" id="service">
            </div>
        </div>
        <div class="col md-4">
            <div class="form-group">
                <label for="Name" class="h6">Image</label>
                <input disabled class="form-control m-2 fs-6" type="text" name="img" id="img">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col md-4">
            <label for="name" class="h6">Description</label>
            <textarea disabled class="form-control fs-6" rows="4" cols="50" name="description"
                id="description"></textarea>
        </div>
    </div>
</form>
