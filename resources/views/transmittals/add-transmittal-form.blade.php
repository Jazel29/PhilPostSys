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
            <p>{{ session('flash_msg') }}</p>
        </div>
        @endif
    </div>
</div>
<form action="/addRecord" method="POST" class="p-3 needs-validation" onsubmit="submitForm()">
    @csrf
    <div class="add-transmittal-form flex">
        <div class="left-section w-1/2 ">
            <div class="mx-4">          
                <div class="row mt-4">
                    <input type="date" name="date_posted" id="date_posted" class="form-control rounded-md text-19" style="border-color:#a0aec0;" required>
                </div>
                <div class="row mt-2">
                    <input placeholder="Mail Tracking Number" type="text" name="mail_tn" id="mail_tn" class="form-control rounded-md text-19" style="border-color:#a0aec0;" required>
                </div>
                <div class="row mt-2">
                    <input class="form-control rounded-md text-19" list="datalistOptions" id="addresseeDataList" placeholder="Addressee" style="border-color:#a0aec0;" required>
                    <datalist id="datalistOptions">
                    <option value="Add New Addressee"></option>
                    </datalist>
                    <input class="form-control" type="hidden" name="receiver" id="receiver">
                </div>
                <div class="row mt-4">
                   <div class="text-gray-500">
                        Address:
                   </div> 
                    <textarea id="address" name="address" rows="2" class="rounded-md text-19" style="border-color:#a0aec0;"></textarea>
                </div>
            </div>
        </div>    
        <div class="right-section w-1/2" id="addRRR_div">
            <div class="flex flex-col mt-4">
                <div>
                    <div class="flex flex-row">
                        <input placeholder="Tracking Number/s of Registry Return Recepits/Proofs of Delivery" type="text" name="rrr_tn" id="rrr_tn" class="form-control rounded-md text-gray-500 border-gray-500 text-19 ml-1" style="border-color:#a0aec0;">
                        <div>
                            <button type="button" id="add" class="ml-3 btn btn-md text-19 border-2 border-blue-600 hover:text-white hover:bg-blue-600" onclick="addTN()">Add</button>
                        </div>
                    </div>
                    <div class="mt-4 custom-border font-md rounded-md" id="rrr_div" style="border-color:#a0aec0;">
                        <input type="hidden" name="rrr_tns" id="rrr_tns_input">
                    </div>
                    <div class="flex justify-end mt-3">
                        <button type="submit" class="btn border-2 btn-md border-blue-600 hover:text-white hover:bg-blue-600">Submit</button>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</form>

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
            <div class="mssg">
                @if(session('record_added'))
                    <div class="alert alert-primary" role="alert">
                        <p>{{ session('record_added') }}</p>
                    </div>
                    <script>
                        $(document).ready(function () {
                            $('#newAddresseeModal').modal('show');
                        });
                    </script>
                @endif
            </div>
            <form action="/add_addressee" method="post">
                @csrf
                <div class="modal-body">
                    <!-- Add your form fields for adding a new addressee here -->
                    <!-- Example: -->
                    <input type="text" name="nameAbbrev" id="nameAbbrev" class="form-control mb-2" placeholder="Addressee Abbreviation" required>
                    <input type="text" name="namePrimary" id="namePrimary" class="form-control mb-2" placeholder="Addressee Name Line 1" required>
                    <input type="text" name="nameSecondary" id="nameSecondary" class="form-control mb-2" placeholder="Addressee Name Line 2">
                    <input type="text" name="address" id="address" class="form-control mb-2" placeholder="Floor/Bldg/Street/Barangay ">
                    <input type="text" name="city" id="city" class="form-control mb-2" placeholder="City/Municipality" required>
                    <input type="text" name="zip" id="zip" class="form-control mb-2" placeholder="Zip Code" required>
                    <input type="text" name="province" id="province" class="form-control mb-2" placeholder="Province" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" onclick="closeModal()">Close</button>
                    <button type="submit" class="btn btn-outline-primary" onclick="saveAddresee()">Save Addressee</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="content mt-5">
    <div class="d-flex justify-content-center">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
</div>
   
<script>
    var rrr_tns = [];
    var count = 0;

    function removeTN(element, rrr_tn_value) {
        // Remove the container from the DOM
        element.parentNode.removeChild(element);

        // Remove the corresponding rrr_tn_value from the rrr_tns array
        var index = rrr_tns.indexOf(rrr_tn_value);
        if (index !== -1) {
            rrr_tns.splice(index, 1);
        }

        // Log the updated rrr_tns array (for testing purposes)
        console.log(rrr_tns);
        updateCounts();
    }

    function updateCounts() {
    // Get all tn_containers in the rrr_div
        var tnContainers = document.getElementById('rrr_div').getElementsByClassName('container');

        // Update the counts based on the current index in the rrr_tns array
        for (var i = 0; i < tnContainers.length; i++) {
            var countElement = tnContainers[i].getElementsByTagName('p')[0];
            countElement.innerText = (i + 1) + '. ' + rrr_tns[i];
        }
    }

    function addTN() {
        var rrr_tn_value = document.getElementById('rrr_tn').value;

        // Check if rrr_tn_value is truthy before appending
        if (rrr_tn_value) {
            // Add the rrr_tn_value to the rrr_tns array
            rrr_tns.push(rrr_tn_value);

            // Get the current index in the rrr_tns array
            var count = rrr_tns.length;

            // Create a new tn_container with the extracted value
            var tn_container = document.createElement('div');
            tn_container.className = 'container';
            tn_container.innerHTML = '<span class="exit-button" onclick="removeTN(this.parentNode, \'' + rrr_tn_value + '\')">✖</span><p>' + count + ". " + rrr_tn_value + '</p>';

            // Append the new tn_container to the rrr_div
            document.getElementById('rrr_div').appendChild(tn_container);

            // Clear the value of rrr_tn input field
            document.getElementById('rrr_tn').value = '';

            // Log the updated rrr_tns array (for testing purposes)
            console.log(rrr_tns);
        }
    }


    var rrr_tn_value = document.getElementById("rrr_tn");
    rrr_tn_value.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            addTN();
        }
    });

    var mailTn = document.getElementById("mail_tn");
    mailTn.addEventListener("keypress", function(evt) {
        if (event.key === "Enter") {
            evt.preventDefault();
        }
    });

    function submitForm() {

        // Set the rrr_tns array value to the hidden input
        document.getElementById('rrr_tns_input').value = JSON.stringify(rrr_tns);

        // Submit the form
        document.forms[0].submit();
    }

    
    document.getElementById('addresseeDataList').addEventListener('input', function() {
        var addressValue = document.getElementById('address');
        var addresseeVal = document.getElementById('receiver');
        var RRRdiv = document.getElementById('addRRR_div');
        var popUp = document.getElementById('popover-content');
        var tn = document.getElementById('mail_tn');
        var selectedValue = this.value;

        if (selectedValue === 'Add New Addressee') {
            $('#newAddresseeModal').modal('show');
            this.value = '';
        } else {
            // Get the selected option element
            var selectedOption = document.querySelector('#datalistOptions option[value="' + selectedValue + '"]');
            
            // Check if the selected option exists
            if (selectedOption) {
                selectedId = selectedOption.id;
                var selectedAddressee = addressees.find(addressee => addressee.id == selectedId)
                addressValue.value = selectedAddressee.address + " " + selectedAddressee.city + " " + selectedAddressee.zip + " " + selectedAddressee.province;
                addresseeVal.value = selectedId;
                RRRdiv.style.display = 'block';
                popUp.style.display = 'none';
            } else {
                addressValue.value = '';
                RRRdiv.style.display = 'none';
                popUp.style.display = 'block';

            }
            
            if(!selectedOption & selectedValue == '') {
                popUp.style.display = 'none';
            }
        }
    });


    function closeModal() {
        $('#newAddresseeModal').modal('hide');
    }

    function openModal() {
        $('#newAddresseeModal').modal('show');
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
                addressees = data.addressees; // Store addressees globally for later access

                addressees.forEach(addressee => {
                    const option = document.createElement('option');
                    option.value = `${addressee.abbrev} - ${addressee.name_primary}`;
                    option.id = addressee.id;
                    datalist.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching addressees:', error));
    });
    
    $(document).ready(function () {
        $('#mail_tn').on('blur', function () {
            var mail_tn = $(this).val();

            // Perform AJAX request to check existence
            $.ajax({
                type: 'GET',
                url: '/checkMailTN', // Replace with your actual route
                data: { mail_tn: mail_tn },
                success: function (response) {
                    if (response.exists) {
                        $('#mail_tn_error').text('Mail Tracking Number already exists');
                    } else {
                        $('#mail_tn_error').text('');
                    }
                },
                error: function (error) {
                    console.error('Error checking Mail Tracking Number:', error);
                }
            });
        });
    });

</script>