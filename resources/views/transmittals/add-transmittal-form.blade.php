<style>
    .custom-border {
        border: 2px solid #333; /* Change #333 to the desired dark color code */
        padding: 20px;
        margin-left: 5px;
        max-width: 540px;
    }

    .container {
        position: relative;
        max-width: 200px;
        margin-left: 5px;
        margin-right: 20px;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .exit-button {
        position: absolute;
        top: 20px;
        right: 10px;
        cursor: pointer;
        font-size: 18px;
        color: #333;
    }    
</style>
<div class="row">
    <h1 class="display-5"> New Transmittal </h1>
    <input type="button" value="Click me" onclick="testModal()">
</div>
<div class="mssg">
    @if(session('flash_mssg'))
    <div class="alert alert-primary" role="alert">
        <p>{{ session('flash_mssg') }}</p>
    </div>
    @endif
</div>
<form action="/addRecord" method="POST" class="p-3">
    @csrf
    <div class="row mt-4">
        <div class="col-6">
            <input placeholder="Select date" type="date" name="date_posted" id="date_posted" class="form-control">
            <i class="fas fa-calendar input-prefix" tabindex=0></i>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6">
            <input placeholder="Mail Tracking Number" type="text" name="mail_tn" id="mail_tn" class="form-control">
            <i class="fas fa-calendar input-prefix" tabindex=0></i>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6">
        <input class="form-control" list="datalistOptions" id="addresseeDataList" placeholder="Addressee" name="receiver">
            <datalist id="datalistOptions">
                <option value="San Francisco">
                <option value="New York">
                <option value="Seattle">
                <option value="Los Angeles">
                <option value="Chicago">
                <option value="Add New Addressee"></option>
            </datalist>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col" style="max-width: 500px;">
            <input placeholder="Tracking Number/s of Registry Return Recepits/Proofs of Delivery" type="text" name="rrr_tn" id="rrr_tn" class="form-control">
            <i class="fas fa-calendar input-prefix" tabindex=0></i>
        </div>
        <div class="col-2">
            <button type="button" id="add" class="btn btn-outline-success btn-sm" onclick="addTN()">Add</button>
        </div>
    </div>
    
    {{-- comment ko muna kasi for testing --}}
    {{-- <div class="row mt-5">
        <div class="col" style="max-width: 500px;">
                <input placeholder="Tracking Number/s of Registry Return Recepits/Proofs of Delivery" type="text" name="rrr_tn" id="rrr_tn" class="form-control">
                <i class="fas fa-calendar input-prefix" tabindex=0></i>
                </div>
                <div class="col-2">
                <button type="button" id="add" class="btn btn-outline-success btn-sm" onclick="addTN()">Add</button>
        </div>
    </div> --}}

    {{-- <div class="row mt-5 custom-border" id="rrr_div"> --}}
    </div>
    <div class="row mt-3">
        <div class="col-6 text-right">
            <button type="submit" class="btn btn-outline-success">Submit</button>
        </div>
    </div>
</form>
<!-- Modal -->
<div class="modal fade" id="newAddresseeModal" tabindex="-1" role="dialog" aria-labelledby="newAddresseeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newAddresseeModalLabel">Add New Addressee</h5>
            </div>
            <form action="/add_addressee" method="post">
                @csrf
                <div class="modal-body">
                    <!-- Add your form fields for adding a new addressee here -->
                    <!-- Example: -->
                    <input type="text" name="nameAbbrev" id="nameAbbrev" class="form-control mb-2" placeholder="Addressee Abbreviation">
                    <input type="text" name="namePrimary" id="namePrimary" class="form-control mb-2" placeholder="Addressee Name Line 1">
                    <input type="text" name="nameSecondary" id="nameSecondary" class="form-control mb-2" placeholder="Addressee Name Line 2">
                    <input type="text" name="address" id="address" class="form-control mb-2" placeholder="Address">
                    <input type="text" name="city" id="city" class="form-control mb-2" placeholder="City">
                    <input type="text" name="zip" id="zip" class="form-control mb-2" placeholder="Zip Code">
                    <input type="text" name="province" id="province" class="form-control mb-2" placeholder="Province">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" onclick="closeModal()">Close</button>
                    <button type="submit" class="btn btn-outline-primary" onclick="saveNewAddressee()">Save Addressee</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="content mt-5">
    <div class="d-flex justify-content-center">
        displahy the content here
    </div>
</div>
   

<script src="path/to/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>

    document.getElementById('addresseeDataList').addEventListener('input', function() {
    // Get the selected value from the input
    var selectedValue = this.value;
    // Check if the selected value matches "Add New Addressee"
    if (selectedValue === 'Add New Addressee') {
        // Show the newAddresseeModal
        $('#newAddresseeModal').modal('show');
        // Clear the value to prevent triggering again on modal close
        this.value = '';
    } 
});

function closeModal() {
    $('#newAddresseeModal').modal('hide');
}

function saveNewAddressee() {
    // Add logic to save the new addressee data
    // Example: You can use AJAX to send a request to the server
    // and update the datalist options dynamically.
    
    // After saving, close the modal
    $('#newAddresseeModal').modal('hide');
}

function testModal() {
    $('#newAddresseeModal').modal('show');
}


</script>