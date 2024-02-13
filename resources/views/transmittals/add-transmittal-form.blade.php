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
    </div>
</div>
   

<script src="path/to/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    var count = 0;
    function removeTN(element) {
    // Remove the container from the DOM
        element.parentNode.removeChild(element);
    }

//     function addTN() {
//         count++;
//         var rrr_tn_value = document.getElementById('rrr_tn').value;

//         // Create a new tn_container with the extracted value
//         var tn_container = document.createElement('div');
//         tn_container.className = 'container';
//         tn_container.innerHTML = '<span class="exit-button" onclick="removeTN(this.parentNode)">✖</span><p>' + count + ". "+ rrr_tn_value + '</p>';

    // Append the new tn_container to the rrr_div
        document.getElementById('rrr_div').appendChild(tn_container);

    // Clear the value of rrr_tn input field
        document.getElementById('rrr_tn').value = '';
    }

//     var rrr_tn_value = document.getElementById("rrr_tn");
//     rrr_tn_value.addEventListener("keypress", function(event) {
//         if (event.key === "Enter") {
//             event.preventDefault();
//             addTN();
//         }
//     });

    document.getElementById('addRecordForm').addEventListener('submit', function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();

        // Serialize form data
        var formData = new FormData(this);

        // Send AJAX request
        fetch('/addRecord', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Handle successful form submission
            console.log('Success:', data);
            // Optionally, you can show a success message or perform other actions
        })
        .catch(error => {
            // Handle errors
            console.error('Error:', error);
            // Optionally, you can show an error message to the user
        });
    });

    document.getElementById('addresseeDataList').addEventListener('input', function() {
    var selectedValue = this.value;
        if (selectedValue === 'Add New Addressee') {
            $('#newAddresseeModal').modal('show');
            this.value = '';
        } 
    });

    function closeModal() {
        $('#newAddresseeModal').modal('hide');
    }

    function saveNewAddressee() {
        $('#newAddresseeModal').modal('hide');
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Fetch addressees from the server
        fetch('/get-addressees')
            .then(response => response.json())
            .then(data => {
                const datalist = document.getElementById('datalistOptions');
                const addressees = data.addressees;

                addressees.forEach(addressee => {
                    const option = document.createElement('option');
                    option.value = `${addressee.abbrev} - ${addressee.name_primary} - ${addressee.name_secondary}`;
                    datalist.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching addressees:', error));
    });



</script>