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
            <div class="mt-3 mr-6">
                <div class="flex justify-end">
                    <button type="submit" class="btn text-19 border-2 border-blue-600 hover:text-white hover:bg-blue-600">Submit</button>
                </div>
            </div>
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
    </div>
</div>
   

<script src="path/to/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
//     var count = 0;
//     function removeTN(element) {
// // Remove the container from the DOM
//         element.parentNode.removeChild(element);
//     }

//     function addTN() {
//         count++;
//         var rrr_tn_value = document.getElementById('rrr_tn').value;

//         // Create a new tn_container with the extracted value
//         var tn_container = document.createElement('div');
//         tn_container.className = 'container';
//         tn_container.innerHTML = '<span class="exit-button" onclick="removeTN(this.parentNode)">✖</span><p>' + count + ". "+ rrr_tn_value + '</p>';

// // Append the new tn_container to the rrr_div
//         document.getElementById('rrr_div').appendChild(tn_container);

// // Clear the value of rrr_tn input field
//         document.getElementById('rrr_tn').value = '';
//     }

//     var rrr_tn_value = document.getElementById("rrr_tn");
//     rrr_tn_value.addEventListener("keypress", function(event) {
//         if (event.key === "Enter") {
//             event.preventDefault();
//             addTN();
//         }
//     });

    // document.getElementById('addRecordForm').addEventListener('submit', function(event) {
    //     // Prevent the default form submission behavior
    //     event.preventDefault();

    //     // Serialize form data
    //     var formData = new FormData(this);

    //     // Send AJAX request
    //     fetch('/addRecord', {
    //         method: 'POST',
    //         body: formData,
    //         headers: {
    //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    //         }
    //     })
    //     .then(response => {
    //         if (!response.ok) {
    //             throw new Error('Network response was not ok');
    //         }
    //         return response.json();
    //     })
    //     .then(data => {
    //         // Handle successful form submission
    //         console.log('Success:', data);
    //         // Optionally, you can show a success message or perform other actions
    //     })
    //     .catch(error => {
    //         // Handle errors
    //         console.error('Error:', error);
    //         // Optionally, you can show an error message to the user
    //     });
    // });

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