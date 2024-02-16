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

<div class="ml-4">
    <div>
        <h1 class="display-5"> Add New Transmittal </h1>
    </div>
    <div class="mssg">
        @if(session('flash_mssg'))
        <div class="alert alert-primary" role="alert">
            <p>{{ session('flash_mssg') }}</p>
        </div>
        @endif
    </div>
</div>
<form action="/addRecord" method="POST" class="">
    @csrf
    <div class="living-room-settings flex">
        <div class="left-section w-1/2 ">
            <div class="mx-4">
                <div class="row mt-4">
                    <input placeholder="Select date" type="date" name="date_posted" id="date_posted" class="form-control rounded-md text-19">
                    <i class="fas fa-calendar input-prefix" tabindex=0></i>
                </div>
                <div class="row mt-2">
                    <input placeholder="Mail Tracking Number" type="text" name="mail_tn" id="mail_tn" class="form-control rounded-md text-19">
                    <i class="fas fa-calendar input-prefix" tabindex=0></i>
                </div>
                <div class="row mt-2">
                    <input class="form-control rounded-md text-19" list="datalistOptions" id="addresseeDataList" placeholder="Addressee" name="receiver">
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
        </div>

        <div class="right-section w-1/2">
            <div class="flex flex-col mt-4">
                <div class="mx-4">
                    <div class="flex flex-row">
                        <input placeholder="Tracking Number/s of Registry Return Receipts/Proofs of Delivery" type="text" name="rrr_tn" id="rrr_tn" class="form-control rounded-md text-gray-500 border-gray-500 text-19">
                        <i class="fas fa-calendar input-prefix text-gray-500" tabindex=0></i>
                        <div>
                            <button type="button" id="add" class="ml-3 btn btn-md text-19 border-2 border-blue-600 hover:text-white hover:bg-blue-600" onclick="addTN()">Add</button>
                        </div>
                    </div>

                    <div class="mt-3 form-control rounded-md h-20 border-gray-300 text-gray-300"></div>      
                </div>          
            </div>
        </div>    
    </div>
    <div class="flex justify-end mr-4 mt-3"> 
        <button type="button" class="btn border-2 btn-md border-blue-600 hover:text-white hover:bg-blue-600" data-toggle="modal" data-target="#submitConfirmationModal">
            Submit
        </button>
    </div>
</form>


<!--Modal for Submit Button-->
<div class="modal fade" id="submitConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="submitConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h5 class="modal-title mb-3" id="submitConfirmationModalLabel">Are you sure you want to save this record?</h5>                
                <hr>
                <div class="mt-3 mb-2 d-flex justify-content-end">
                    <button type="button" class="btn btn-outline-secondary rounded-4 mr-1" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-outline-primary rounded-4 ml-1" onclick="submitForm()">Yes, Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    // Function to handle form submission
    function submitForm() {
        // Add logic to submit the form
        // Example: You can use AJAX to send a request to the server

        // After submission, close the modal
        $('#submitConfirmationModal').modal('hide');
    }
</script>

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
    </div>
</div>

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